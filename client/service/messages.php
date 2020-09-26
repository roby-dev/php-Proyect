<?php

class Message{

    public function getMessages($tipo){
        if($tipo=="errorarchivo"){
                echo '<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalError" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header error">
                            <h5 class="modal-title" id="modalError">ERROR</h5>                              
                          </div>
                          <div class="modal-body p-4">
                            Solo puede subir archivos Word o PDF!
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>            
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                         $(function(){
                          $("#modalError").modal();
                         });
                    </script>';
        }
        if($tipo=="error"){
             echo '<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalError" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header error">
                            <h5 class="modal-title" id="modalError">ERROR</h5>                                
                          </div>
                          <div class="modal-body p-4">
                            Numero de DNI ya registrado para esta convocatoria!
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>            
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                         $(function(){
                          $("#modalError").modal();
                         });
                    </script>';
        }
        if($tipo=="success"){
            echo '  <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="modalError" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header success">
                                    <h5 class="modal-title text-muted" id="modalError">FELICITACIONES</h5>                                
                                </div>
                                <div class="modal-body text-muted">
                                    ESTAS REGISTRADO EN LA CONVOCATORIA, NO OLVIDES CONTESTAR ESTAS PREGUNTAS PARA TENER MAS OPCION DE INGRESAR AL PUESTO!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>            
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                         $(function(){
                          $("#modalError").modal();
                         });
                    </script>';
        }
          if($tipo=="success2"){
            echo '  <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="modalError" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header success">
                                    <h5 class="modal-title text-muted" id="modalError">FELICITACIONES</h5>                                
                                </div>
                                <div class="modal-body text-muted">
                                    ESTÁS REGISTRADO EN LA CONVOCATORIA, ESPERA LOS RESULTADOS!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>            
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                         $(function(){
                          $("#modalError").modal();
                         });
                    </script>';
        }
        if($tipo=="errorRespuesta"){
          echo '  <div class="modal fade" data-backdrop="static" data-keyboard="false"  id="modalError" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog  modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header error">
                                  <h5 class="modal-title text-muted" id="modalError">Error</h5>                                
                              </div>
                              <div class="modal-body text-muted">
                                  Redes neuronales detectaron que no eres gosu para el trabajo
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>            
                              </div>
                          </div>
                      </div>
                  </div>
                  <script type="text/javascript">
                       $(function(){
                        $("#modalError").modal();
                       });
                  </script>';
    }
  }
}
