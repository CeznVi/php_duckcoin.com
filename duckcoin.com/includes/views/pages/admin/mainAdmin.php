<section id="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title">Панель адміністратора</h2>
                    <p>Тут можливо змінити деякі налаштування сайту</p>
                </div>
            </div>

<!--- Початок акордеона-->
            <div class="row">
                <div class="col-md-12">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
<!-- Створення опції-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Створити опцію
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
<!-- ЛОГІКА Створення опції-->
                                    <form id="createOption" method="post" action="/admin/createOption">
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
                                                    <input type="text" class="form-control" placeholder="Group"
                                                           name="groupBy"
                                                           id="groupBy">
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
<!-- КІНЕЦЬ ЛОГІКА Створення опції-->
                                </div>
                            </div>
                        </div>
<!-- КІНЕЦЬ Створення опції-->

 <!-- РЕДАГУВАННЯ опції-->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Редагування опцій
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
<!-- ЛОГІКА Створення опції-->
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
                                                            <?php if($opt['canDelete'] == "true") { ?>
                                                                <input type="submit" class="btn btn-danger" value="remove"  name="action" />
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    <?php }
                                    ?>
<!-- КІНЕЦЬ ЛОГІКи Створення опції-->
                                </div>
                            </div>
                        </div>
<!-- КІНЕЦЬ РЕДАГУВАННЯ опції-->


<!--                        <div class="accordion-item">-->
<!--                            <h2 class="accordion-header" id="flush-headingThree">-->
<!--                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">-->
<!--                                    Accordion Item #3-->
<!--                                </button>-->
<!--                            </h2>-->
<!--                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">-->
<!--                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->


                </div>
            </div>
<!--- КІНЕЦЬ акордеона-->
        </div>
</section>


