<h1 class="admin py-4">Forms filled by users</h1>

<div ng-controller="mainCtrl">
    <table st-table="displayed" class="table table-striped">
    <thead>
    <tr>
        <th st-ratio="20" st-sort="firstName">First name</th>
        <th st-ratio="20" st-sort="lastName">Last name</th>
        <th st-ratio="30" st-sort="email">Email</th>
        <th st-ratio="30" st-sort="message">Message</th>
    </tr>
    </thead>
    <tbody>
    <!-- Data as a result of Data process and extract() -->
    <?php foreach ( $data as $print ) {?>
    <tr ng-repeat="row in displayed">
        <td st-ratio="20"><?= $print->name;?></td>
        <td st-ratio="20"><?= $print->surname;?></td>
        <td st-ratio="10"><?= $print->email;?></td>
        <td st-ratio="10"><?= $print->message;?></td>
    </tr><?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="text-center">
            <div  st-items-by-page="20" st-pagination=""></div>
        </td>
    </tr>
    </tfoot>
    </table>
</div>