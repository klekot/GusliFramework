<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header"><?php echo 'Модель: ' . $this->modelName . ' '; ?></h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <?php foreach ($this->modelFields as $modelField): ?>
                <th><?php echo $modelField ?></th>
                <?php endforeach; ?>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($this->model->all() as $modelRow): ?>
                    <tr>
                        <?php foreach ($this->modelFields as $modelField): ?>
                            <td><?php echo $modelRow->{$modelField}; ?></td>
                        <?php endforeach; ?>
                        <td width="10%">
                            <a href="./add-model" >
                                <span class="glyphicon glyphicon-plus-sign add-model" aria-hidden="true"></span>
                            </a>&nbsp;&nbsp;
                            <a href="./edit-model" >
                                <span class="glyphicon glyphicon-edit edit-model" aria-hidden="true"></span>
                            </a>&nbsp;&nbsp;
                            <a href="./delete-model" >
                                <span class="glyphicon glyphicon-minus-sign delete-model" aria-hidden="true"></span>
                            </a>&nbsp;&nbsp;
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>