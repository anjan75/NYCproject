<?php require APPROOT . '/views/inc/header.php'; ?>
<h3>Ehost Table Employee Details</h3>
<hr />
  <div class="row">
      <div class="col-md-12">
          <table class="table table-striped ehost-users">
            <thead>
            <tr>
              <th>BSC_EMPLID</th>
              <th>WORK_FOR_AGENCY_EMPLID</th>
              <th>WORK_FOR_AGENCY</th>
              <th>EMPL_STATUS</th>
              <th>LAST_NAME</th>
              <th>FIRST_NAME</th>
              <th>MIDDLE_NAME</th>
              <th>DEPTID</th>
              <th>DEPT_DESCR</th>
              <th>JOBCODE</th>
              <th>JOBCODE_DESCR</th>
              <th>B_SAFETY_SENSTV</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data['users'] as $u) { ?>
              <?php $u = (array) $u; ?>
            <tr>
              <td><?php echo $u['BSC_EMPLID']; ?></td>
              <td><?php echo $u['WORK_FOR_AGENCY_EMPLID']; ?></td>
              <td><?php echo $u['WORK_FOR_AGENCY']; ?></td>
              <td><?php echo $u['EMPL_STATUS']; ?></td>
              <td><?php echo $u['LAST_NAME']; ?></td>
              <td><?php echo $u['FIRST_NAME']; ?></td>
              <td><?php echo $u['MIDDLE_NAME']; ?></td>
              <td><?php echo $u['DEPTID']; ?></td>
              <td><?php echo $u['DEPT_DESCR']; ?></td>
              <td><?php echo $u['JOBCODE']; ?></td>
              <td><?php echo $u['JOBCODE_DESCR']; ?></td>
              <td><?php echo $u['B_SAFETY_SENSTV']; ?></td>
              

            </tr>
              <?php } ?>
            </tbody>
          </table>
      </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>