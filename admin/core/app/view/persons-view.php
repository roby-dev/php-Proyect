<section class="content">
	<div class="row">

		<div class="col-md-12">
			<h1>Solicitudes de Trabajo</h1>

			<br>
			<?php

			$users = PersonData::getAll();
			if (count($users) > 0) {

			?>
				<div class="box box-primary">
					<div class="box-body">
						<ul class="ul-jobs">
							<li>Seleccione Trabajo &nbsp;<span class='glyphicon glyphicon-triangle-bottom'></span>
								<ul>
									<li><a href='index.php?view=persons'>Limpiar...</a></li>
									<?php
									$jobs = JobData::getAll();
									foreach ($jobs as $job) {
									?>
										<li><a href='index.php?view=persons&id=<?php echo $job->id; ?>'><?php echo $job->name ?></a></li>
									<?php
									}
									?>
								</ul>
							</li>
						</ul>
						<table class="table table-bordered table-hover datatable">
							<thead>
								<th>Nombre completo</th>
								<th>DNI</th>
								<th>Vacante</th>
								<th>Categoria</th>
								<th>Lugar</th>
								<th>Status</th>
								<th>Creacion</th>
								<th></th>
							</thead>
							<?php
							foreach ($users as $user) {

								$job = JobData::getById($user->job_id);
								if (!isset($_GET['id'])) {
							?>
									<tr>
										<td><?php echo $user->name . " " . $user->lastname; ?></td>
										<td><?php echo $user->dni; ?></td>
										<td><?php echo $job->name; ?></td>
										<td><?php echo CategoryData::getById($job->category_id)->name; ?></td>
										<td><?php echo PlaceData::getById($job->place_id)->name; ?></td>
										<td><?php
											switch ($user->status) {
												case null:
													echo "<span style='color:green'>Pendiente</span>";
													break;
												case 3:
													echo "<span style='color:red'><b>No Apto</b></span>";
													break;
												case 1:
													echo "<span style='color:blue'>Aceptado</span>";
													break;
												case 2:
													echo "<span style='color:blue'><b>Contratado</b></span>";
													break;
												case 0:
													echo "<span style='color:red'>Rechazado</span>";
													break;

												default:
													break;
											}
											?></td>
										<td><?php echo $user->created_at; ?></td>
										<td style="width:180px;">
											<a href="./uploads/<?php echo $user->file; ?>" target="_blank" class="btn btn-default btn-xs">Ver CV</a>
											<?php if ($user->status == '1') : ?>
												<a href="index.php?action=persons&opt=accepCont&id=<?php echo $user->id; ?>" class="btn btn-success btn-xs">Contratar</a>
												<a href="index.php?action=persons&opt=denied&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">Rechazar</a>

											<?php endif; ?>
											<?php if ($user->status === null) : ?>
												<a href="index.php?action=persons&opt=accept&id=<?php echo $user->id; ?>" class="btn btn-info btn-xs">Aceptar</a>
												<a href="index.php?action=persons&opt=deniedEnt&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">No Apto</a>

											<?php endif; ?>
											<a href="index.php?action=persons&opt=del&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar</a>
											<a role="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#editModal<?php echo $user->id; ?>">Ver Respuestas</a>

									</tr>
									<?php
								} else {
									if ($_GET['id'] == $job->id) {

									?>
										<tr>
											<td><?php echo $user->name . " " . $user->lastname; ?></td>
											<td><?php echo $user->dni; ?></td>
											<td><?php echo $job->name; ?></td>
											<td><?php echo CategoryData::getById($job->category_id)->name; ?></td>
											<td><?php echo PlaceData::getById($job->place_id)->name; ?></td>
											<td><?php
												switch ($user->status) {
													case null:
														echo "<span style='color:green'>Pendiente</span>";
														break;
													case 3:
														echo "<span style='color:red'><b>Rechazado</b></span>";
														break;
													case 1:
														echo "<span style='color:blue'>Aceptado</span>";
														break;
													case 2:
														echo "<span style='color:blue'><b>Contratado</b></span>";
														break;
													case 0:
														echo "<span style='color:red'>No Apto</span>";
														break;

													default:
														break;
												}
												?></td>
											<td><?php echo $user->created_at; ?></td>
											<td style="width:180px;">
												<a href="./uploads/<?php echo $user->file; ?>" target="_blank" class="btn btn-default btn-xs">Ver CV</a>
												<?php if ($user->status == '1') : ?>
													<a href="index.php?action=persons&opt=accepCont&id=<?php echo $user->id; ?>&job=<?php echo $job->id; ?>" class="btn btn-success btn-xs">Contratar</a>
													<a href="index.php?action=persons&opt=denied&id=<?php echo $user->id; ?>&job=<?php echo $job->id; ?>" class="btn btn-danger btn-xs">Rechazar</a>

												<?php endif; ?>
												<?php if ($user->status === null) : ?>
													<a href="index.php?action=persons&opt=accept&id=<?php echo $user->id; ?>&job=<?php echo $job->id; ?>" class="btn btn-info btn-xs">Aceptar</a>
													<a href="index.php?action=persons&opt=deniedEnt&id=<?php echo $user->id; ?>&job=<?php echo $job->id; ?>" class="btn btn-danger btn-xs">No Apto</a>

												<?php endif; ?>
												<a href="index.php?action=persons&opt=del&id=<?php echo $user->id; ?>&job=<?php echo $job->id; ?>" class="btn btn-warning btn-xs">Editar</a>
												<a role="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#editModal<?php echo $user->id; ?>">Ver Respuestas</a>

										</tr>
							<?php
									}
								}
							}

							?>
						</table>
						<?php


						?>
						<?php foreach ($users as $user) : ?>
							<!-- Modal -->
							<div class="modal fade" id="editModal<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Respuestas >> <?php echo $user->name . '' . $user->lastname; ?></h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=places&opt=update" role="form">
												<?php

												$respuestas = UserQuestionData::getById($user->id);
												foreach ($respuestas as $respuesta) :
												?>
													<div class="form-group" style="width:90%;margin:0px auto;">
														<label class="col-10"><?php echo $respuesta->description; ?></label>
														<input type="text" disabled class="form-control col-10" value="<?php echo $respuesta->answer; ?>">
													</div>
												<?php endforeach; ?>

												<div class="form-group" style="margin-top:2em;">
													<div class="col-lg-offset-2 col-lg-10">
														<input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
														<button type="button" class="btn btn-primary btn-lg col-12" data-dismiss="modal" aria-label="Close">Okay</button>
													</div>
												</div>
											</form>

										</div>

									</div>
								</div>
							</div>
						<?php endforeach; ?>


					<?php

				} else {
					echo "<p class='alert alert-danger'>No hay Solicitudes de Trabajo</p>";
				}


					?>


					</div>
				</div>

</section>