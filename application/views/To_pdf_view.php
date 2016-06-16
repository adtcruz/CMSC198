<!DOCTYPE html>
<html>
<head>
	<title>sample</title>
</head>
<body>
	<table width = "700" border = "2">
		<tr>
			<td>
				<table border = "1" width = "100%">
						<tr>
							<td rowspan = "5">
								<?php echo img ('assets/images/logo.jpg') ?>
							</td>
							<td>
								UPLB Information Technology Center
							</td>
							<td>
								(Accomplish in Duplicate)
							</td>
						</tr>
						<tr>
							<td>
								University of the Philippines Los Banos
							</td>
							<td>
								Job Request No.
							</td>
						</tr>
						<tr>
							<td>
								Job Request Form
							</td>
							<td>
								Date
							</td>
						</tr>
						<tr>
							<td>
								Telephone
							</td>
							<td>
								Time Finished
							</td>
						</tr>
						<tr>
							<td>
								Email
							</td>
							<td>
								Time Started
							</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border = "1" width = "100%">
						<tr>
							<th colspan = "2">
								Client Info
							</th>
						</tr>
						<tr>
							<td>
								Printed Name: <?php session_start (); echo $_SESSION['username']; ?>
							</td>
							<td>
								Designation:
							</td>
						</tr>
						<tr>
							<td>
								Office / Unit:
							</td>
							<td>
								Tel. No.: 
							</td>
						</tr>
						<tr>
							<td colspan = "2">
								Location of Work:
							</td>
						</tr>
						<tr>
							<td colspan = "2">
								Work to be done / Problem(s) Encountered:
							</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border = "1" width = "100%">
						<tr>
							<th colspan = "4">
								Services Info
							</th>
						</tr>
						<tr>
							<td>
								Description
							</td>
							<td>
								Quantity
							</td>
							<td>
								Unit Cost
							</td>
							<td>
								Total Cost
							</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border = "1" width = "100%">
					<tr>
						<th colspan = "4">
							Bill of Materials
						</th>
					</tr>
					<tr>
						<td>
							Description
						</td>
						<td>
							Remarks
						</td>
						<td>
							Quantity
						</td>
						<td>
							Unit
						</td>
					</tr>
					<tr>
						<td>
							Materials Used
						</td>
						<td> &nbsp; </td>
						<td> &nbsp; </td>
						<td> &nbsp; </td>
					</tr>
					<tr>
						<td>
							Materials Harvested
						</td>
						<td> &nbsp; </td>
						<td> &nbsp; </td>
						<td> &nbsp; </td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border = "1" width = "100%">
					<tr>
						<th colspan = "4">
							Recommended Materials / Equipment for Purchase
						</th>
					</tr>
					<tr>
						<td>
							Item Specification
						</td>
						<td>
							Quantity
						</td>
						<td>
							Unit
						</td>
						<td>
							Unit Cost
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>