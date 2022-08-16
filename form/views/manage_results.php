<!DOCTYPE html>
<html>
<head>
	<title>Form Builder | Form Result</title>
	<link rel="icon" href="images/rm.png">
	<?php include 'stylesheets.php'; ?>
	<?php include 'scripts.php'; ?>
</head>
<body>

	<div>
		<div class="panel-body">
			<h3><?= htmlspecialchars($survey->survey_name); ?></h3>
			<br>
			<table class="table" id="table_results">
				<thead>
					<tr>
						<th>#</th>
						<?php foreach ($survey->questions as $question): ?>
							<th><?php echo htmlspecialchars($question->question_text); ?></th>
						<?php endforeach; ?>
						<th>Time Taken</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($survey->responses)): ?>
						<tr>
							<td colspan="<?php echo count($survey->questions)+2; ?>"><em>No results</em></td>
						</tr>
						<?php else: ?>
		
						<?php foreach ($survey->responses as $key => $response): ?>
							<tr>
								<td><?= $key+1 ?>.</td>
								<?php foreach ($survey->questions as $ctr => $question): ?>
									<td>
										<?php 
											
											if($ctr + 1 == 1){
										?>
										<a href="/manage_results.php?del=<?php echo $response->survey_response_id ?>" class="btn btn-danger">Delete</a>&nbsp;
										<a href="/view_results.php?res_id=<?php echo $response->survey_response_id ?>">
										<?php 
										$field = 'question_' . htmlspecialchars($question->question_id); 
										echo htmlspecialchars(substr($response->$field,0,50)); 
										?>
										</a>
										<?php

											}else{
												$field = 'question_' . htmlspecialchars($question->question_id); 
												echo htmlspecialchars(substr($response->$field,0,50));
											}
							
										?>
									</td>
								<?php 
								
									endforeach; 
								?>
								<td class="text-center">
									<?php
										$date = new DateTime($response->time_taken, new DateTimeZone('GMT'));
										$date->setTimezone(new DateTimeZone('Asia/Manila'));
										echo $date->format('M d, Y h:i A');
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<?php include 'footer.php'; ?>
	</div>

	<script type="text/javascript">
		$(function() {
			$('.download_csv').button({ icons: { primary: 'ui-icon-document' } });
			$('.view_charts').button({ icons: { primary: 'ui-icon-image' } });

			$("#table_results").DataTable({
				order       : [
						[0, 'desc']
					],
				lengthMenu  : [
						[10, 20, 50, 100, -1], 
						[10, 20, 50, 100, "All"]
					]
			});
		});
	</script>
	
</body>
</html>