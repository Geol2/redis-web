<?php
echo "총 응답시간 : " .  $data['spend_time']. " (sec)<pre>";
?>
    <table>
        <thead>
        <tr>
            <th>순위</th>
            <th>검색어</th>
            <th>검색횟수</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data['ranking'] as $key => $value) { ?>
            <tr>
                <td><?= $value['rank'] ?></td>
                <td><?= $value['keyword'] ?></td>
                <td><?= $value['score'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php
exit();