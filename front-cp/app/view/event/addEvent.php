<? include(ROOT . "view/layout/header.inc.php"); ?>
<? if(isset($data['topevent']) && !empty($data['topevent']) ){ $topev = $data['topevent']; } ?>
<? //var_dump($data); ?>
		<div class="form-join-create clearfix">

			<div class="head-join-create clearfix">
				<div class="join-event columns medium-9">
					<div class="clearfix">
						<h1><? echo JOIN; ?></h1>
			
						<form class="search-bar" method="get" action="">
							<input type="text" size="21"><input class="icon-search" type="submit" value="">
						</form>
					</div>
                    <? foreach($topev as $k => $topev){ ?>
					<a href="" onClick="ga('send', 'event', 'link','clic', 'join-this-event');">
						<div class="sticker columns large-3 medium-4">
							<div class="wrapper">
								<div class="img">
									<img src="img/event/<? echo $topev['event_img']; ?>">
									<div class="hover">
										<span>Join this event !</span>
									</div>
								</div>
								<h2><? echo $topev['event_name']; ?></h2>
								<span class="info-event"><? echo $topev['event_location']; ?> - EDITION <? echo substr($topev['event_date'], 0, 4); ?></span>
							</div>
						</div>
					</a>
					<? } ?>
				</div>
				<a href="" onClick="ga('send', 'event', 'link','clic', 'create-your-event');"></a>
					<div class="create-event columns medium-3">
						<div class="create-box">
							<div class="wrapper">
								<img src="img/add_icon.svg">
								<span>Create your own event !</span>							
							</div>
						</div>
					</div>
				</a>
			</div>

			<div class="tabs">
				<h1><span>Create </span>your own event !</h1>
			    <ul class="tab-links">
			        <li class="active"><a onClick="ga('send', 'event', 'link','clic', 'edit-event');" href="#tab1">Edit</a></li>
			        <li><a onClick="ga('send', 'event', 'link','clic', 'preview-event');" href="#tab2">Preview</a></li>
			    </ul>

			    <p>Hi, do you have an idea of sports event which could help the planet ?</br>Let's create !</p>
			 
			    <div class="tab-content">
			        <div id="tab1" class="tab active">
			        
			            <form id="form_create" class="" name="form_create" enctype="multipart/form-data" action="?module=event&action=addevent" method="post" >

			            	<div class="clearfix">
			            		<div class="medium-8 columns first">
			            			<label class="" for="name" >Name (required)</label>
									<div>
										<a href="" onClick="ga('send', 'event', 'link','clic', 'create-event-name');">
											<input id="" name="name" class="" type="text" maxlength="255" value="" required /> 
										</a>
									</div> 
									<label class="" for="place">City (required)</label>
									<div>
										<a href="" onClick="ga('send', 'event', 'link','clic', 'create-event-city');">
											<input id="place" name="place" class="" type="text" maxlength="255" value="" required />
										</a> 
									</div> 
									<select name="country"required>
										<option value="">Country</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="American Samoa">American Samoa</option>
										<option value="Andorra">Andorra</option>
										<option value="Angola">Angola</option>
										<option value="Anguilla">Anguilla</option>
										<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="Barbados">Barbados</option>
										<option value="Belarus">Belarus</option>
										<option value="Belgium">Belgium</option>
										<option value="Belize">Belize</option>
										<option value="Benin">Benin</option>
										<option value="Bermuda">Bermuda</option>
										<option value="Bhutan">Bhutan</option>
										<option value="Bolivia">Bolivia</option>
										<option value="Bonaire">Bonaire</option>
										<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
										<option value="Botswana">Botswana</option>
										<option value="Brazil">Brazil</option>
										<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
										<option value="Brunei">Brunei</option>
										<option value="Bulgaria">Bulgaria</option>
										<option value="Burkina Faso">Burkina Faso</option>
										<option value="Burundi">Burundi</option>
										<option value="Cambodia">Cambodia</option>
										<option value="Cameroon">Cameroon</option>
										<option value="Canada">Canada</option>
										<option value="Canary Islands">Canary Islands</option>
										<option value="Cape Verde">Cape Verde</option>
										<option value="Cayman Islands">Cayman Islands</option>
										<option value="Central African Republic">Central African Republic</option>
										<option value="Chad">Chad</option>
										<option value="Channel Islands">Channel Islands</option>
										<option value="Chile">Chile</option>
										<option value="China">China</option>
										<option value="Christmas Island">Christmas Island</option>
										<option value="Cocos Island">Cocos Island</option>
										<option value="Colombia">Colombia</option>
										<option value="Comoros">Comoros</option>
										<option value="Congo">Congo</option>
										<option value="Cook Islands">Cook Islands</option>
										<option value="Costa Rica">Costa Rica</option>
										<option value="Cote D'Ivoire">Cote D'Ivoire</option>
										<option value="Croatia">Croatia</option>
										<option value="Cuba">Cuba</option>
										<option value="Curacao">Curacao</option>
										<option value="Cyprus">Cyprus</option>
										<option value="Czech Republic">Czech Republic</option>
										<option value="Denmark">Denmark</option>
										<option value="Djibouti">Djibouti</option>
										<option value="Dominica">Dominica</option>
										<option value="Dominican Republic">Dominican Republic</option>
										<option value="East Timor">East Timor</option>
										<option value="Ecuador">Ecuador</option>
										<option value="Egypt">Egypt</option>
										<option value="El Salvador">El Salvador</option>
										<option value="Equatorial Guinea">Equatorial Guinea</option>
										<option value="Eritrea">Eritrea</option>
										<option value="Estonia">Estonia</option>
										<option value="Ethiopia">Ethiopia</option>
										<option value="Falkland Islands">Falkland Islands</option>
										<option value="Faroe Islands">Faroe Islands</option>
										<option value="Fiji">Fiji</option>
										<option value="Finland">Finland</option>
										<option value="France">France</option>
										<option value="French Guiana">French Guiana</option>
										<option value="French Polynesia">French Polynesia</option>
										<option value="French Southern Ter">French Southern Ter</option>
										<option value="Gabon">Gabon</option>
										<option value="Gambia">Gambia</option>
										<option value="Georgia">Georgia</option>
										<option value="Germany">Germany</option>
										<option value="Ghana">Ghana</option>
										<option value="Gibraltar">Gibraltar</option>
										<option value="Great Britain">Great Britain</option>
										<option value="Greece">Greece</option>
										<option value="Greenland">Greenland</option>
										<option value="Grenada">Grenada</option>
										<option value="Guadeloupe">Guadeloupe</option>
										<option value="Guam">Guam</option>
										<option value="Guatemala">Guatemala</option>
										<option value="Guinea">Guinea</option>
										<option value="Guyana">Guyana</option>
										<option value="Haiti">Haiti</option>
										<option value="Hawaii">Hawaii</option>
										<option value="Honduras">Honduras</option>
										<option value="Hong Kong">Hong Kong</option>
										<option value="Hungary">Hungary</option>
										<option value="Iceland">Iceland</option>
										<option value="India">India</option>
										<option value="Indonesia">Indonesia</option>
										<option value="Iran">Iran</option>
										<option value="Iraq">Iraq</option>
										<option value="Ireland">Ireland</option>
										<option value="Isle of Man">Isle of Man</option>
										<option value="Israel">Israel</option>
										<option value="Italy">Italy</option>
										<option value="Jamaica">Jamaica</option>
										<option value="Japan">Japan</option>
										<option value="Jordan">Jordan</option>
										<option value="Kazakhstan">Kazakhstan</option>
										<option value="Kenya">Kenya</option>
										<option value="Kiribati">Kiribati</option>
										<option value="Korea North">Korea North</option>
										<option value="Korea South">Korea South</option>
										<option value="Kuwait">Kuwait</option>
										<option value="Kyrgyzstan">Kyrgyzstan</option>
										<option value="Laos">Laos</option>
										<option value="Latvia">Latvia</option>
										<option value="Lebanon">Lebanon</option>
										<option value="Lesotho">Lesotho</option>
										<option value="Liberia">Liberia</option>
										<option value="Libya">Libya</option>
										<option value="Liechtenstein">Liechtenstein</option>
										<option value="Lithuania">Lithuania</option>
										<option value="Luxembourg">Luxembourg</option>
										<option value="Macau">Macau</option>
										<option value="Macedonia">Macedonia</option>
										<option value="Madagascar">Madagascar</option>
										<option value="Malaysia">Malaysia</option>
										<option value="Malawi">Malawi</option>
										<option value="Maldives">Maldives</option>
										<option value="Mali">Mali</option>
										<option value="Malta">Malta</option>
										<option value="Marshall Islands">Marshall Islands</option>
										<option value="Martinique">Martinique</option>
										<option value="Mauritania">Mauritania</option>
										<option value="Mauritius">Mauritius</option>
										<option value="Mayotte">Mayotte</option>
										<option value="Mexico">Mexico</option>
										<option value="Midway Islands">Midway Islands</option>
										<option value="Moldova">Moldova</option>
										<option value="Monaco">Monaco</option>
										<option value="Mongolia">Mongolia</option>
										<option value="Montserrat">Montserrat</option>
										<option value="MA">Morocco</option>
										<option value="MZ">Mozambique</option>
										<option value="MM">Myanmar</option>
										<option value="NA">Nambia</option>
										<option value="NU">Nauru</option>
										<option value="NP">Nepal</option>
										<option value="AN">Netherland Antilles</option>
										<option value="NL">Netherlands (Holland, Europe)</option>
										<option value="NV">Nevis</option>
										<option value="NC">New Caledonia</option>
										<option value="NZ">New Zealand</option>
										<option value="NI">Nicaragua</option>
										<option value="NE">Niger</option>
										<option value="NG">Nigeria</option>
										<option value="NW">Niue</option>
										<option value="NF">Norfolk Island</option>
										<option value="NO">Norway</option>
										<option value="OM">Oman</option>
										<option value="PK">Pakistan</option>
										<option value="PW">Palau Island</option>
										<option value="PS">Palestine</option>
										<option value="PA">Panama</option>
										<option value="PG">Papua New Guinea</option>
										<option value="PY">Paraguay</option>
										<option value="PE">Peru</option>
										<option value="PH">Philippines</option>
										<option value="PO">Pitcairn Island</option>
										<option value="PL">Poland</option>
										<option value="PT">Portugal</option>
										<option value="PR">Puerto Rico</option>
										<option value="QA">Qatar</option>
										<option value="ME">Republic of Montenegro</option>
										<option value="RS">Republic of Serbia</option>
										<option value="RE">Reunion</option>
										<option value="RO">Romania</option>
										<option value="RU">Russia</option>
										<option value="RW">Rwanda</option>
										<option value="NT">St Barthelemy</option>
										<option value="EU">St Eustatius</option>
										<option value="HE">St Helena</option>
										<option value="KN">St Kitts-Nevis</option>
										<option value="LC">St Lucia</option>
										<option value="MB">St Maarten</option>
										<option value="PM">St Pierre &amp; Miquelon</option>
										<option value="VC">St Vincent &amp; Grenadines</option>
										<option value="SP">Saipan</option>
										<option value="SO">Samoa</option>
										<option value="AS">Samoa American</option>
										<option value="SM">San Marino</option>
										<option value="ST">Sao Tome &amp; Principe</option>
										<option value="SA">Saudi Arabia</option>
										<option value="SN">Senegal</option>
										<option value="RS">Serbia</option>
										<option value="SC">Seychelles</option>
										<option value="SL">Sierra Leone</option>
										<option value="SG">Singapore</option>
										<option value="SK">Slovakia</option>
										<option value="SI">Slovenia</option>
										<option value="SB">Solomon Islands</option>
										<option value="OI">Somalia</option>
										<option value="ZA">South Africa</option>
										<option value="ES">Spain</option>
										<option value="LK">Sri Lanka</option>
										<option value="SD">Sudan</option>
										<option value="SR">Suriname</option>
										<option value="SZ">Swaziland</option>
										<option value="SE">Sweden</option>
										<option value="CH">Switzerland</option>
										<option value="SY">Syria</option>
										<option value="TA">Tahiti</option>
										<option value="TW">Taiwan</option>
										<option value="TJ">Tajikistan</option>
										<option value="TZ">Tanzania</option>
										<option value="TH">Thailand</option>
										<option value="TG">Togo</option>
										<option value="TK">Tokelau</option>
										<option value="TO">Tonga</option>
										<option value="TT">Trinidad &amp; Tobago</option>
										<option value="TN">Tunisia</option>
										<option value="TR">Turkey</option>
										<option value="TU">Turkmenistan</option>
										<option value="TC">Turks &amp; Caicos Is</option>
										<option value="TV">Tuvalu</option>
										<option value="UG">Uganda</option>
										<option value="UA">Ukraine</option>
										<option value="AE">United Arab Emirates</option>
										<option value="GB">United Kingdom</option>
										<option value="US">United States of America</option>
										<option value="UY">Uruguay</option>
										<option value="UZ">Uzbekistan</option>
										<option value="VU">Vanuatu</option>
										<option value="VS">Vatican City State</option>
										<option value="VE">Venezuela</option>
										<option value="VN">Vietnam</option>
										<option value="VB">Virgin Islands (Brit)</option>
										<option value="VA">Virgin Islands (USA)</option>
										<option value="WK">Wake Island</option>
										<option value="WF">Wallis &amp; Futana Is</option>
										<option value="YE">Yemen</option>
										<option value="ZR">Zaire</option>
										<option value="ZM">Zambia</option>
										<option value="ZW">Zimbabwe</option>
									</select>

									<div class="clearfix date">
										<div class="medium-6 from columns">
										
										<label for="date-from">Beginning date (required)</label>
										<div>
											<a href="" onClick="ga('send', 'event', 'link','clic', 'create-event-date-begin');">
												<input class="input-xlarge focused" id="dateBegin" name="from" type="date" value="" required>
											</a>
										</div>
									</div>
										<div class="medium-6 to columns">
											<label for="date-to">Ending date (required)</label>
											<div>
												<a href="" onClick="ga('send', 'event', 'link','clic', 'create-event-date-ending');">
													<input class="input-xlarge focused" id="dateEnd" name="end" type="date" value="" required>
												</a>
											</div>
										</div>
									</div>
			            		</div>					
							
								<div class="medium-4 columns second">
									<div class="fileupload clearfix">
										<img src="img/camera.png">
										<span>Add a cover, it's better !</span>
										<a onClick="ga('send', 'event', 'link','clic', 'create-event-input');" href="">
											<input  type="file" name="cover"/>											
										</a>
									</div>
								</div>
				       		</div>
								 
								<label class="" for="description">Tell us more about your idea ! </label>
									<div>
										<a onClick="ga('send', 'event', 'link','clic', 'create-event-desc');" href="">
											<textarea id="description" name="descr" required></textarea> 
										</a>
									</div> 
			    
								<a href="arrivee.html" onClick="ga('send', 'event', 'link','clic', 'validate-createv3');"><input id="saveForm" class="button-submit" type="submit" name="submit" value="Validate" /></a>
						</form>
			       	</div>
			 
			        <div id="tab2" class="tab">
						<p>This service is currently unavailable.

							I hope that will not last too long :)</p>
			        </div>
			    </div>
			</div>
<?php include(ROOT . "view/layout/footer.inc.php"); ?>