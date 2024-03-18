<?php if ($this->controller->getAction() == 'view') { ?>
   <div class="ccm-dashboard-header-buttons">
      <a href="<?= URL::to('/dashboard/planning_tool/appointments/agenda')?>" class="btn btn-primary btn-sm">Agenda</a>
      <a href="<?= URL::to('/dashboard/planning_tool/setappointments/')?>" class="btn btn-success btn-sm">Add new</a>
   </div>
   <div class="table-responsive">
    <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
        <thead>
            <tr>
                <th class="">Name</th>
                <th class="">Lastname</th>
                <th class="">Email</th>
                <th class="">Phone number</th>
                <th class="">Comment</th>
                <th class="">Person</th>
                <th class="">Date</th>
                <th class="">Start time</th>
                <th class="">End time</th>
                <th class="">Expertise</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($appointments)) {
                foreach ($appointments as $appointment) { ?>
                    <tr data-launch-search-menu="" class="">
                        <td><?php echo $appointment->getFirstname(); ?></td>
                        <td><?php echo $appointment->getLastname(); ?></td>
                        <td><?php echo $appointment->getEmail(); ?></td>
                        <td><?php echo $appointment->getPhonenumber(); ?></td>
                        <td><?php echo $appointment->getComment(); ?></td>
                        <td>
                            <?php
                            $personObject = $appointment->getPersonObject();

                            // Check if the personObject is not null before accessing its properties
                            if ($personObject !== null) {
                                echo $personObject->getFirstname();
                            } else {
                                // Handle the case where personObject is null
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td><?php echo $appointment->getAppointmentDatetime(); ?></td>
                        <td><?php echo $appointment->getAppointmentStartTime(); ?></td>
                        <td><?php echo $appointment->getAppointmentEndTime(); ?></td>
                        <td>
                            <?php
                            $expertiseObject = $appointment->getExpertiseObject();

                            // Check if the personObject is not null before accessing its properties
                            if ($expertiseObject !== null) {
                                echo $expertiseObject->getFirstname();
                            } else {
                                // Handle the case where personObject is null
                                echo 'N/A';
                            }
                            ?>
                        </td>
                        <td align="right">
                            <div class="btn-group" role="group">
                                <a href="<?= URL::to('/dashboard/planning_tool/appointments/edit', $appointment->getItemID()); ?>" class="btn btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= URL::to('/dashboard/planning_tool/appointments/delete', $appointment->getItemID()); ?>" class="btn btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else { ?>
                <tr>
                    <td colspan="11" class="text-center">No data found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit appointment</h2><br>
   <form method="post" action="<?=$this->action('saveAppointment', $appointment->getItemID()); ?>" class="row g-3">

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="<?php echo $appointment->getFirstname(); ?>" required>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="<?php echo $appointment->getLastname(); ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="<?php echo $appointment->getEmail(); ?>" required>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="number" class="form-label">Phone number</label>
                <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="<?php echo $appointment->getPhonenumber(); ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="comment" class="form-label">Comment</label>
                <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value="<?php echo $appointment->getComment(); ?>">
            <div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="personID" class="form-label">With who?</label>
                <select id="personID" name="personID" class="form-select">
                    <?php foreach ($persons as $person) { ?>
                        <option value="<?= $person->getItemID(); ?>" <?php if ($appointment->getPerson() == $person->getItemID()) echo 'selected'; ?>>
                            <?= $person->getFirstname(); ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="help-block">"Select the person you have a appointment with."</div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="comment" class="form-label">Expertise</label>
                <input type="text" id="expertiseID" name="expertiseID" class="form-control" value="<?php echo $appointment->getExpertise(); ?>">
                <div class="help-block">"Select the expertise that the appointment is about."</div>
            </div>    
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="comment" class="form-label">Date</label>
                <input type="date" id="appointmentDatetime" name="appointmentDatetime" class="form-control hasDatepicker" value="<?php echo $appointment->getAppointmentDatetime(); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="comment" class="form-label">Start time</label>
                <input type="time" id="appointmentStartTime" name="appointmentStartTime" class="form-control" value="<?php echo $appointment->getAppointmentStartTime(); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="comment" class="form-label">End time</label>
                <input type="time" id="appointmentEndTime" name="appointmentEndTime" class="form-control" value="<?php echo $appointment->getAppointmentEndTime(); ?>">
            </div>
        </div>
    </div>
      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php  } else if ($this->controller->getAction() == 'agenda') { ?>
    <style>
    .calendar {
      width: 100%;
      border-collapse: collapse;
    }

    .calendar td {
      border: 1px solid #ddd;
      padding: 10px;
      height: 100px;
    }

    .time-slot {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="text-center mb-4">Calendar</h2>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <table class="table table-bordered calendar">
        <thead>
          <tr>
            <th scope="col">Time</th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $timeSlots = array(
            "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
            "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM",
            "05:00 PM", "06:00 PM", "07:00 PM", "08:00 PM"
          );

          foreach ($timeSlots as $timeSlot) {
            echo "<tr>";
            echo "<td class='time-slot'>$timeSlot</td>";
            for ($i = 0; $i < 7; $i++) {
              echo "<td></td>";
            }
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php  } ?>