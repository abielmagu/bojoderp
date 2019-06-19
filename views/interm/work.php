<?php 
$work = $data['work'];
$kinds 	= $GLOBALS['works'];
$status_work = $GLOBALS['statusWork'];
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead"><b>DETAILS</b></p>
        </div>
        <div class="col-xs-6 text-right">
            <a href="?date=<?= $data['date'] ?>" class="btn btn-primary btn-sm">
                <span>BACK</span>
            </a>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <?php $status = $status_work[ $work['status'] ] ?>
                        <b class="text-<?= $status['color'] ?> text-uppercase small"><?= $status['tag'] ?></b>
                    </div>
                    <div class="panel-title">Work</div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="">Type</label>
                        <p><?= $kinds[ $work['kind'] ] ?></p>
                    </div>    
                    <div class="form-group">
                        <label for="">Scheduled</label>
                        <p class="text-uppercase"><?= $work['scheduled_at'] ?></p>
                    </div> 
                    <div class="form-group">
                        <label for="">Closed</label>
                        <p class="text-uppercase"><?= $work['closed_at'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Start work</label>
                        <p><?= $work['started_at'] ?></p>
                    </div> 
                    <div class="form-group">
                        <label for="">Done work</label>
                        <p><?= $work['finished_at'] ?></p>
                    </div> 
                    <div class="form-group">
                        <label for="">Crew</label>
                        <p><?= $work['nick_crew'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Workers</label>
                        <p><?= $work['workers'] ?></p>
                    </div>
                </div>
            </div> 
        </div>

        <div class="col-md-4"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Details</div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <?php foreach($data['details'] as $key => $value): ?>
                            <tr>
                                <td><?= $key ?></td>
                                <td><?= $value ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Client</div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <p><?= $work['name'].' '.$work['lastname'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <p style="margin:0"><?= $work['address'] ?> <?= $work['zip'] ?></p>
                        <p class="text-uppercase text-muted"><small><?= $work['city'] ?>, <?= $work['state'] ?></small></p>
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <p><?= $work['phone'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <p><?= $work['email'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
