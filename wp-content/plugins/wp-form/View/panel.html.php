<h1 class="admin py-4">Forms filled by users</h1>

<div ng-controller="mainCtrl">
    <table st-table="displayed" class="table table-striped">
    <thead>
    <tr>
        <th st-ratio="10" st-sort="firstName">First name</th>
        <th st-ratio="10" st-sort="lastName">Last name</th>
        <th st-ratio="10" st-sort="email">Email</th>
        <th st-ratio="10" st-sort="message">Message</th>
        <th st-ratio="30" st-sort="delete"></th>
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
        <form method="POST">
            <td st-ratio="10">
                <input type="hidden" name="get_id" value="<?= $print->id;?>">
                <button style="border:0;outline:none;background:none;" type="submit" name="delete">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/delete.svg " />
                </button>
            </td>
        </form>
    </tr><?php } ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7" class="text-center">
            <div  st-items-by-page="20" st-pagination=""></div>
        </td>
    </tr>
    </tfoot>
    </table>
</div>