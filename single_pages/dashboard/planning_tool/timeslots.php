<?php if ($this->controller->getAction() == 'view') { ?>
   <header>  
      <div class="ccm-dashboard-header-menu">
         <a href="<?= URL::to('/dashboard/planning_tool/timeslots/add')?>" class="btn btn-success btn-sm">Add new</a>
      </div>
   </header>
   <div class="table-responsive">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Date</th>
               <th class="">Start date</th>
               <th class="">End time</th>
               <th class="">Appointment time</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($timeSlots)) {
                  foreach ($timeSlots as $timeSlot) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?=$timeSlot->getItemID(); ?></td>
                     <td><?=$timeSlot->getDay(); ?></td>
                     <td><?=$timeSlot->getStartTime(); ?></td>
                     <td><?=$timeSlot->getEndTime(); ?></td>
                     <td><?=$timeSlot->getAppointmentTime(); ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/timeslots/edit',  $timeSlot->getItemID()); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/timeslots/delete',  $timeSlot->getItemID()); ?>"  class="btn btn-danger btn-sm">delete</a></td>
                  </tr>
                  <?php } 
               } else { ?>
                  <p>No data found.</p>
               <?php } ?>
         </tbody>    
      </table>
   </div>
 <?php } else if ($this->controller->getAction() == 'add') { ?>
   <h2>Add timeslots</h2>
   <form method="post" action="<?=$this->action('saveTimeSlot')?>">
   <label for="name" class="form-label">Datum</label>
      <input type="text" id="timeslotsDays" name="timeslotsDays" class="form-control ccm-input-text mb-3" value="" required>
      <div class="row">
         <div class="col-12 col-md-6">
            <div class="form-group">
               <label for="startTime" class="form-label">Starttijd</label><input type="time" id="timeSlotsStartTime" name="timeSlotsStartTime" class="form-select"  value="" required>
            </div>
         </div>
         <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="endTime" class="form-label">Eindtijd</label><input type="time" id="timeSlotsEndTime" name="timeSlotsEndTime" class="form-select" value="" required>
            </div>
         </div>
      </div>
      <label for="endTime" class="form-label">Appointment time</label>
      <input type="integer" id="appointmentTime" name="appointmentTime" class="form-control ccm-input-text" value="" required>
      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveTimeSlot', $timeSlot->getItemID()); ?>">
   <label for="name" class="form-label">Datum</label>
      <input type="text" id="timeslotsDays" name="timeslotsDays" class="form-control ccm-input-text mb-3" value="<?=$timeSlot->getDay(); ?>" required>
      <div class="row">
         <div class="col-12 col-md-6">
            <div class="form-group">
               <label for="startTime" class="form-label">Starttijd</label><input type="time" id="timeSlotsStartTime" name="timeSlotsStartTime" class="form-select" value="<?=$timeSlot->getStartTime(); ?>" required>
            </div>
         </div>
         <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="endTime" class="form-label">Eindtijd</label><input type="time" id="timeSlotsEndTime" name="timeSlotsEndTime" class="form-select" value="<?=$timeSlot->getEndTime(); ?>" required>
            </div>
         </div>
      </div>
      <label for="endTime" class="form-label">Appointment time</label>
      <input type="integer" id="appointmentTime" name="appointmentTime" class="form-control ccm-input-text" value="<?=$timeSlot->getAppointmentTime(); ?>" required>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } ?>


<!-- <span class="ccm-input-time-wrapper row row-cols-auto gx-1 align-items-center" id="formScheduleDateFrom_tw">
   <div class="col-auto">
      <select class="form-select" id="formScheduleDateFrom_h" name="formScheduleDateFrom_h">
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12" selected="selected">12</option>
      </select>
   </div>
   <div class="col-auto"><span class="separator me-0">:</span></div>
   <div class="col-auto">
      <select class="form-select" id="formScheduleDateFrom_m" name="formScheduleDateFrom_m">
         <option value="00">00</option>
         <option value="01">01</option>
         <option value="02">02</option>
         <option value="03">03</option>
         <option value="04">04</option>
         <option value="05">05</option>
         <option value="06">06</option>
         <option value="07">07</option>
         <option value="08">08</option>
         <option value="09">09</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
         <option value="13">13</option>
         <option value="14">14</option>
         <option value="15">15</option>
         <option value="16">16</option>
         <option value="17">17</option>
         <option value="18">18</option>
         <option value="19">19</option>
         <option value="20">20</option>
         <option value="21">21</option>
         <option value="22">22</option>
         <option value="23">23</option>
         <option value="24">24</option>
         <option value="25">25</option>
         <option value="26">26</option>
         <option value="27">27</option>
         <option value="28">28</option>
         <option value="29">29</option>
         <option value="30">30</option>
         <option value="31">31</option>
         <option value="32">32</option>
         <option value="33">33</option>
         <option value="34">34</option>
         <option value="35">35</option>
         <option value="36">36</option>
         <option value="37">37</option>
         <option value="38">38</option>
         <option value="39">39</option>
         <option value="40">40</option>
         <option value="41">41</option>
         <option value="42">42</option>
         <option value="43">43</option>
         <option value="44">44</option>
         <option value="45">45</option>
         <option value="46">46</option>
         <option value="47">47</option>
         <option value="48">48</option>
         <option value="49">49</option>
         <option value="50">50</option>
         <option value="51">51</option>
         <option value="52">52</option>
         <option value="53">53</option>
         <option value="54">54</option>
         <option value="55" selected="selected">55</option>
         <option value="56">56</option>
         <option value="57">57</option>
         <option value="58">58</option>
         <option value="59">59</option>
      </select>
   </div>
   <div class="col-auto">
      <select class="form-select" id="formScheduleDateFrom_a" name="formScheduleDateFrom_a">
         <option value="AM">AM</option>
         <option value="PM" selected="selected">PM</option>
      </select>
   </div>
</span> -->


