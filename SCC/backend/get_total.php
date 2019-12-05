<?php

//if (!isset($_SESSION)) {session_start();}

//$group_id = $_GET["group_id"];
$sql = "SELECT type, recurrent, flat_fee, extra_fee, discount, charge_rate
        FROM (
                (
                    SELECT e.event_id,
                        e.resource_id,
                        g.event_id AS event_id2
                    FROM `events` e
                    LEFT JOIN `groups` g ON e.event_id = g.event_id
                    WHERE group_id = $group_id
                ) t1

                LEFT JOIN
                (
                    SELECT e2.event_id,
                            e2.event_type_id,
                            e2.resource_id,
                            et.event_type_id AS event_types2,
                            et.type,
                            et.recurrent
                    FROM `events` e2
                    LEFT JOIN `event_types` et ON e2.event_type_id = et.event_type_id
                ) t2

                ON (t1.event_id = t2.event_id)
            )
            LEFT JOIN
            (
                SELECT r.system_charge_rate_id,
                    r.resource_id,
                    r.flat_fee,
                    r.extra_fee,
                    r.discount,
                    s.system_charge_rate_id AS system_charge_rate_id2,
                    s.charge_rate
                FROM `resources` r
                LEFT JOIN `system_charge_rate` s ON r.system_charge_rate_id = s.system_charge_rate_id
            ) t3

            ON (t1.resource_id = t3.resource_id)
";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
/*
echo 'type: ' . $row['type'] . '<br>';
echo 'recurrent: ' . $row['recurrent'] . '<br>';
echo 'flat_fee: ' . $row['flat_fee'] . '<br>';
echo 'extra_fee: ' . $row['extra_fee'] . '<br>';
echo 'discount: ' . $row['discount'] . '<br>';
echo 'charge_rate: ' . $row['charge_rate'] . '<br>';
*/
//if established bandwidth or storage is over, subtract it from base storage, multiply it by charge rate

$total = 0;
$discount = 0;
/*
if ($row['type'] == "non-profit") {
    echo 'non profits pay ' . $total;
} else {

}*/

if ((int) $row['discount'] == 1) {
    $discount = (int) $row['discount'];
}
$total = (int) $row['flat_fee'] + (int) $row['extra_fee'] - (int) $row['discount'];
//echo 'You owe ' . $total;