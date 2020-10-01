<?php include("_header.php"); ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>
                                        <i class="mdi mdi-settings"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
          <?php $i = 1; ?>
          <?php foreach ( $solia as $row ) : ?>
                                  <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["nama_solia"]; ?></td>
                                    <td><?= $row["alamat"]; ?></td>
                                    <td width="160px">
                                        <button type="button" class="btn waves-effect waves-light btn-warning btn-sm editbtn1">
                                          <i class="mdi mdi-pencil-circle"></i> Edit
                                        </button> 
                                        <a href="solia.del.php?id=<?= $row["id_solia"]  ?>" class="btn waves-effect waves-light btn-danger btn-sm" onclick="return confirm('Yakin menghapus data?')">
                                            <i class="mdi mdi-delete-circle"></i> Delete
                                        </a>
                                    </td>
                                  </tr>
          <?php $i++  ?>
          <?php endforeach ?>
                            </tbody>
                        </table>

<?php include("_footer.php"); ?>