	<!-- Modal -->
    <div class="modal fade" id="modalGuiaProducaoMedica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">Guia Produção Médica</h4>
									</div>
									<div class="modal-body">
								 <form role="form" action="" method='post' enctype="multipart/form-data">
								<input type="hidden" name="id" id="idproducao1" />
                                <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="statusOperacao">Guia</label>
                                            <select id="statusBxOperacao" name="statusBxOperacao" class="form-control"> 
                                                    <option value="0">SP/SADT</option>
                                                    <option value="1">Honorário Individual</option> 
                                                    <option value="2">Consulta</option> 																								
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
										<label for="convenio">Convênio</label>
											<select id="convenio0" name="idconvenio" class="form-control"> 
											<option value=""></option>
											<?php
											for($i=0; $i<count($convenios); $i++)
											{
											if($form["idconvenio"] == $convenios[$i]['idconvenio'])
											{	
											?>
											<option value="<?=$convenios[$i]['idconvenio']?>" selected><?=$convenios[$i]['descricao']?></option>
											<?php
											}
											else
											{
											?>
											<option value="<?=$convenios[$i]['idconvenio']?>" ><?=$convenios[$i]['descricao']?></option>
											<?php
											}
											}
											?>
										</select>
									</div>    
									<div class="form-group col-md-3">
										<label for="nome">Número da Guia</label>
												<input class="form-control" type="text" name="numeroGuia" id="numeroGuia">
									</div>
                                    <div class="form-group col-md-3">
										<label for="nome">Guia Principal</label>
												<input class="form-control" type="text" name="guiaPrincipal" id="guiaPrincipal">
									</div>
								</div>

						<div class="row">
									<div class="form-group col-md-3">
											<label class="control-label">Dt.Autorização</label>
											<div class='input-group date' id='dtAutorizacao'>
												 <input type='text' class="form-control" name="dataAutorizacao" id="dataAutorizacao"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									<div class="form-group col-md-3">
										<label for="nome">Senha</label>
												<input class="form-control" type="text" name="senhaAutorizacao" id="senhaAutorizacao">
									</div>		
											
									<div class="form-group col-md-3">
											<label class="control-label">Validade senha</label>
											<div class='input-group date' id='dtValSenha'>
												 <input type='text' class="form-control" name="dataValidadeSenha" id="dataValidadeSenha"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
										<div class="form-group col-md-3">
											<label class="control-label">Emissão guia</label>
											<div class='input-group date' id='dtEmissaoGuia'>
												 <input type='text' class="form-control" name="dataEmissaoGuia" id="dataEmissaoGuia"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>		
									</div>
								<div class="row">
											<!-- DADOS BENEFICIARIOS -->
											<div class="form-group col-md-3">
												<label for="nome">No. Carteira</label>
												<input class="form-control" type="text" name="numeroCarteira" id="numeroCareira">
											</div>
											<div class="form-group col-md-6">
												<label for="nome">Plano</label>
												<input class="form-control" type="text" name="numeroCarteira" id="numeroCareira">
											</div>
											<div class="form-group col-md-3">
											<label class="control-label">Validade Carteira</label>
											<div class='input-group date' id='dtValCarteira'>
												 <input type='text' class="form-control" name="dataValidadeCarteira" id="dataValidadeCarteira"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
											</div>
											
								</div>			
								<div class="row">
									<!-- DADOS BENEFICIARIOS cont. -->
											<div class="form-group col-md-6">
											<label for="nome">Nome Paciente</label>
													<input class="form-control" type="text" name="nomePaciente" id="nomePaciente">
											</div>
											<div class="form-group col-md-3">
											<label for="nome">No.Cartäo Nac. Saúde</label>
													<input class="form-control" type="text" name="numeroCartaoNacionalSaude" id="numeroCartaoNacionalSaude">
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="atendimentoRN" value="true">
												<label class="form-check-label" for="inlineCheckbox1">Atend.RN</label>
											</div>
								</div>
								<div class="row">
								<!-- DADOS DO CONTRATADO (onde foi exewcutado o procedimento) -->
											<div class="form-group col-md-3">
												<label for="nome">Cód. na Op./CNPJ/CPF</label>
													<input class="form-control" type="text" name="codigoContratado" id="codigoContratado">
											</div>	
											<div class="form-group col-md-6">
												<label for="nome">Nome do Contratado</label>
													<input class="form-control" type="text" name="nomeContratado" id="nomeContratado">
											</div>
											<div class="form-group col-md-3">
												<label for="nome">Cód. CNES</label>
													<input class="form-control" type="text" name="codCNES" id="codCNES">
											</div>
								</div>			

								<div class="row">
								<!-- DADOS DO CONTRATADO EXECUTANTE -->
								<div class="form-group col-md-3">
												<label for="nome">Codigo Op./CNPJ/CPF</label>
													<input class="form-control" type="text" name="codigoContratadoExecutante" id="codigoContratadoExecutante">
											</div>
											<div class="form-group col-md-6">
												<label for="nome">Nome Contratado</label>
													<input class="form-control" type="text" name="nomeContratado" id="nomeContratado">
											</div>	
										
											<div class="form-group col-md-3">
												<label for="nome">Profissional Executante</label>
													<input class="form-control" type="text" name="nomeMedicoExecutante" id="nomeMedicoExecutante">
											</div>	
									</div>			
								<div class="row">
											<div class="form-group col-md-3">
													<label for="nome">Grau Participação</label>
													<input class="form-control" type="text" name="grauParticipacao" id="grauParticipacao">
											</div>
											<div class="form-group col-md-3">
													<label for="nome">CRM</label>
													<input class="form-control" type="text" name="crmMedico" id="crmMedico">
											</div>
											<div class="form-group col-md-3">
													<label for="nome">UF</label>
													<input class="form-control" type="text" name="ufCrmMedico" id="ufCrmMedico">
											</div>
											<div class="form-group col-md-3">
													<label for="nome">CPF</label>
													<input class="form-control" type="text" name="cpfMedico" id="cpfMedico">
											</div>
								</div>

									<div class="row">
                                				<div class="form-group col-md-3">
												<label class="control-label">Data Realização</label>
												<div class='input-group date' id='dtBxRealizacao'>
													<input type='text' class="form-control" name="dtBaixaRealizacao" id="dtBaixaRealizacao"/>
													<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
													</span>
													</div>
											</div>	
										<div class="form-group col-md-3">
											<label for="nome">Cód.</label>
											<input class="form-control" type="text" name="codProcedimento" id="codProcedimento">
										</div>
									<div class="form-group col-md-6">
										<label for="nome">Descrição</label>
										<input class="form-control" type="text" name="descProcedimento" id="descProcedimento">
									</div>	
							</div>

										

									<div class="row">
										<div class="form-group col-md-3">
										<label for="nome">Valor Cobrado</label>
											<input class="form-control" type="text" name="valorCobrado" id="valorCobrado">
										</div>
										<div class="form-group col-md-3">
										<label for="nome">Valor Recebido</label>
											<input class="form-control" type="text" name="valorBxRecebido" id="valorBxRecebido" value="0" onchange="getBxSaldo(this.value)">
										</div>
									</div>
			

                                    <div class="row" >
										<div class="form-group col-lg-12">
											<table class="table table-striped table-bordered table-hover" id="tblprocedimentos">
												<thead>
														<tr>
															<th>Cód.</th>
															<th>Procedimento</th>
															<th>Qtd.</th>
															<th>% Ad.</th>
															<th >% Red.</th>
															<th >Valor Unit.</th>
															<th >Valor Total</th>
															<th></th>
														</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
								</div>
								
								<div class="row">
									<div class="form-group col-md-6">
											<label for="nome">Observação</label>
											<input class="form-control" type="text" name="observacaoGuia" id="observacaoGuia">
									</div>
								</div>			
								<div class="row">
									<div class="form-group col-md-3">
											<label class="control-label">Data Pagamento</label>
											<div class='input-group date' id='dtBxPagamento'>
												 <input type='text' class="form-control" name="dtBxPagamento" id="dtBaixaPagamento"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									<div class="form-group col-md-3">
											<label class="control-label">Data Repasse</label>
											<div class='input-group date' id='dtBxRepasse'>
												 <input type='text' class="form-control" name="dtBxRepasse" id="dtBaixaRepasse"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>

										<div class="form-group col-md-3">
											<label class="control-label">Data Cobrança</label>
											<div class='input-group date' id='dtBxCobranca'>
												 <input type='text' class="form-control" name="dtBxCobranca" id="dtBaixaCobranca"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
							</div>

									<div class="modal-footer">
										<button type="button" class="btn btn-default" id="btn-close-modalGuia" data-dismiss="modal">Fechar</button>
										<button  type="button" id="btnGuia" class="btn btn-primary" title="Inserir Guia">Salvar</button>
									
									<!--	<button type="submit" class="btn btn-success">Salvar</button>-->
									</div>	
								</form>
							</div>
						</div>
					</div>
				</div>

			
<script>
		$('[data-dismiss=modal]').on('click', function (e) {
			$('#modalGuiaProducaoMedica').on('hidden.bs.modal', function () {
			$(this).find('form').trigger('reset');
			});
		});
</script>
