
<section id="order-form" class="order_section">
    <div class="container padding">
        <div class="row">
            <div class="col-md-12 appointment_form">
                <h2 class="heading">Керування опціями</h2>
                <hr class="heading_space">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Створити нову опцію
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form id="order_form" class="callus" method="post" action="/admin/createOption">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Value"
                                                       name="value" id="value" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Group" name="groupBy"
                                                       id="groupBy" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="btn-submit btn-common-white">
                                                    <input type="submit" value="Create" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!---РЕДАГУВАННЯ ОПЦІЙ -->
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        foreach ($data['options'] as $index => $opt) { ?>
                            <form id="order_form" class="callus" method="post" action="/admin/updateOption">
                                <div class="row mb-2">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control" placeholder="Id" name="Id" id="Id"
                                                   value="<?= $opt['Id']?>"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Value"
                                                   name="name" id="value" value="<?= $opt['name']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Value"
                                                   name="value" id="value" value="<?= $opt['value']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Group" name="groupBy"
                                                   id="groupBy" value="<?= $opt['groupBy']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div >
                                                <input type="submit" class="btn btn-success" value="update" name="action" />
                                                <input type="submit" class="btn btn-danger" value="remove"  name="action" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
