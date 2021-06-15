<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('messege'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal"> Add New Menu</a>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="submenu">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Path</th>
                            <th scope="col">Module Icon</th>
                            <th scope="col">Module Level</th>
                            <th scope="col">Module Parent</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) :
                            $menuid = $m['module_id'];
                            $menu   = $m['module_nama'];
                            $path   = $m['module_path'];
                            $icons   = $m['module_icons'];
                            $level   = $m['module_level'];
                            $parent   = $m['module_parent_id'];
                            $active   = $m['show_item'];
                        ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $menu; ?></td>
                                <td><?= $path; ?></td>
                                <td><?= $icons; ?></td>
                                <td><?= $level; ?></td>
                                <td><?= $parent; ?></td>
                                <td><?= $active; ?></td>
                                <td>
                                    <span class="btn-menu badge badge-pill badge-warning" data-toggle="modal" data-target="#edit_menu" data-id="<?= $menuid; ?>"> Edit</span>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal add -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('menu'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">New Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Modul ID</label>
                                    <input type="text" class="form-control" id="mid" name="mid" value="<?= $menuid + 1; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Menu</label>
                                    <input type="text" class="form-control" id="amenu" name="menu" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Path</label>
                                    <input type="text" class="form-control" id="apath" name="path" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Icons</label>
                                    <select id="aicons" name="icons" class="form-control" required>
                                        <option disabled selected>Pilih</option>
                                        <option value="fas fa-fw fa-calendar-minus">fas fa-fw fa-calendar-minus</option>
                                        <option value="fas fa-fw fa-broadcast-tower">fas fa-fw fa-broadcast-tower</option>
                                        <option value="fas fa-fw fa-chalkboard-teacher">fas fa-fw fa-chalkboard-teacher</option>
                                        <option value="fas fa-fw fa-coins">fas fa-fw fa-coins</option>
                                        <option value="fab fa-fw fa-hotjar">fab fa-fw fa-hotjar</option>
                                        <option value="fas fa-fw fa-hourglass">fas fa-fw fa-hourglass</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select id="alevel" name="level" class="form-control" required>
                                        <option disabled selected>Pilih</option>
                                        <option value="1">Menu</option>
                                        <option value="2">Submenu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Parent (Jika Submenu, Pilih id Menu nya)</label>
                                    <select id="aparent" name="parent" class="form-control">
                                        <option disabled selected>Pilih</option>
                                        <?php
                                        foreach ($AmbilMenu as $mm) :
                                            $menu_id = $mm['module_id'];
                                            $menu_nama = $mm['module_nama'];
                                        ?>
                                            <option value="<?= $menu_id; ?>"><?= $menu_id . ' - ' . $menu_nama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <select id="aactive" name="active" class="form-control" required>
                                        <option disabled selected>Pilih</option>
                                        <option value="1">Iya</option>
                                        <option value="2">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal edit -->
<div class="modal fade" id="edit_menu" tabindex="-1" role="dialog" aria-labelledby="edit_menuLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('menu/ubah_menu'); ?>" method="post">
            <input type="hidden" id="module_id" name="module_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_menuLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Menu</label>
                                    <input type="text" class="form-control" id="emenu" name="menu">
                                </div>
                                <div class="form-group">
                                    <label>Path</label>
                                    <input type="text" class="form-control" id="epath" name="path">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Icons</label>
                                    <input type="text" class="form-control" id="eicon" name="icons">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" id="elevel" name="level">
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <label>Parent</label>
                                    <input type="text" class="form-control" id="eparent" name="parent">
                                </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <input type="text" class="form-control" id="eactive" name="active">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>