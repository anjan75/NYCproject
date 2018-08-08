<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/dashboards/index"><img style="padding: 1px; width: 30%; height: auto;" src="../public/img/mta.png"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> 
      </button>
 
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inspection Entry
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/general_inspections/index">General Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/speed_inspections/index">Speed Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/trainRide_inspections/index">Train Ride Inspection</a>
            </div>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            MofE Inspection
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/operatingYard_inspections/index">Operating Yard Rules Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/carMover_inspections/index">Car Mover Inspection</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/Equipment_inspections/index">Equipment Safety Observations Inspection</a>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Training Evaluation
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Practice Evaluation</a>
            <a class="dropdown-item" href="#">Final Evaluation</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/inspection_search/index">Inspection Search</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Operating Yard Rules Inspection</a>
            <a class="dropdown-item" href="#">Car Mover Inspection</a>
            <a class="dropdown-item" href="#">Equipment Safety Observations Inspection</a>
            </div>
          </li>
          <?php if(hasPermission('admin')) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            User Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/user_data/index">User Data</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/user_level/index">User Security Levels</a>
            </div>
          </li>
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Rules Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/tasks/index">Tasks</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/rules/index">Rules</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/referenced_rules/index">Referenced Rules</a>
            <a class="dropdown-item" href="#">Tasks-Rules</a>
            <a class="dropdown-item" href="#">Rules-Referenced Rules</a>
            </div>
          </li>

           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Table Data Administration
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/email_groups/index">E-mail Groups</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/railroads/index">Railroad</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/tracks/index">Track Designation</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/speed_source/index">Observed Speed Source</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/lines/index">Lines</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/location_types/index">Location Types</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/locations/index">Locations</a>
            <a class="dropdown-item" href="#">Lines-Location Types</a>
            <a class="dropdown-item" href="#">Location Types-Locations</a>
            <a class="dropdown-item" href="#">Job Codes-Occupation Codes</a>
            <a class="dropdown-item" href="#">Occupation Codes-Process Roles</a>
            <a class="dropdown-item" href="#">Process Roles-Observation Counts</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/timeout/index">System Idle Timedout Time</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/entry_restrictions/index">Observation Date Entry Restrictions</a>
            </div>
          </li>
          <?php endif; ?>

        </ul>

        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item" style="margin-right: 10px;">
              <a class="text-dark nav-link btn btn-light" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="text-dark nav-link btn btn-light" href="<?php echo URLROOT; ?>/users/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
 
  </nav>