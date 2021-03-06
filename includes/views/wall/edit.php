<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-24
 * Time: 3:23 PM
 */
?>
<div id="confirmDelete1" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>Close my account</strong></h4>
            </div>
            <div class="modal-body">
                <h4>Are you really really really really really sure you want to delete your account?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-success"
                        data-dismiss="modal">I have realized deleting my account
                    is a stupid idea
                </button>
                <br/>
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-danger"
                        data-toggle="modal" data-target="#confirmDelete2">I am a loser and want to delete my
                    account.
                </button>
            </div>
        </div>
    </div>
</div>
<div id="confirmDelete2" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <h4>Ok look, permanent means forever, and forever is a very long time. </h4>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-success"
                        data-dismiss="modal">Permanent is too much of a commitment for me, <br/> I'll keep my account.
                </button>
                <br/>
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-danger"
                        data-toggle="modal" data-target="#confirmDelete3">
                    I'm not 4 years old, I understand this is permanent.
                </button>
            </div>
        </div>
    </div>
</div>
<div id="confirmDelete3" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <p>I don't think you understood the first time. This is going to permanently close your account.</p>

                <p>"Forever has no meaning when you're living in the moment. I wasn't ready for that moment to end."
                    -Ellen Hopkins</p>

                <p>Take her advice dude, keep leaving in the moment</p>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-success"
                        data-dismiss="modal">She's right! Let me live in the moment!
                </button>
                <br/>
                <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder" class="btn btn-danger"
                        data-toggle="modal" data-target="#confirmDelete4">
                    Who cares what Hellen Hopkins thinks.
                </button>
            </div>
        </div>
    </div>
</div>
<div id="confirmDelete4" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="<?= URL . 'wall/deleteMyAccountAndAllAssociatedData' ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Last time, I Promise</h4>
                </div>
                <div class="modal-body">
                    <h3>Ok ok ok. Last chance, after this there is 110% no turning back. I guarantee it.</h3>
                    <p>Just to be sure, type in your password below to confirm this is something
                        you actually want to do.</p>
                    <label for="delPass"><strong>Confirm your password: </strong></label>
                    <input type="password" id="delPass" name="deletePassword" required/>
                </div>
                <div class="modal-footer">
                    <button type="button" style="width: 100%; font-size: 16px; font-weight: bolder"
                            class="btn btn-success" data-dismiss="modal">Too scary, I'd rather keep my account.
                    </button>
                    <br/>
                    <button type="submit" style="width: 100%; font-size: 16px; font-weight: bolder"
                            class="btn btn-danger">
                        I Understand that I will have no friends now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<form method="post" action="<?= URL . 'register/doUpdateUser/' . Session::get('my_user')['id'] ?>"
      enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div
                class=" col-xs-10 col-sm-6 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-heading" style="font-size: 24px; font-weight: bold;">Edit my account</div>
                        <hr/>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->profileImageError)) { ?>
                                    <div class="alert alert-warning alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <?= $this->profileImageError ?>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="uname"><strong>Profile Picture:</strong></span>
                                    <a href="#" data-toggle="modal" data-target="#lightbox">
                                        <img class="media-object thumbnail"
                                             src="<?= URL . $this->user['profile_picture'] ?>" alt="..."
                                             style="display: inline-block; height: 3.5em; margin: 0"></a>

                                    <div class="fileUpload btn btn-default" style="margin:0">
                                        <span><i class="fa fa-camera" aria-hidden="true"></i>Change Profile</span>
                                        <input type="file" name="picture" class="upload" accept="image/*"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->usernameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <?= $this->usernameError ?>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="uname"><strong>Username:</strong></span>
                                    <input type="text" class="form-control" aria-describedby="uname"
                                           type="text" pattern="^([A-z]|\d){2,16}$" name=username
                                           id=username title="Between 6 and 16 alphanumeric characters"
                                        <?php if (isset($this->user['username'])) {
                                            echo "placeholder='" . $this->user['username'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->passwordError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->passwordError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="pword"><strong>*Password: </strong></span>
                                    <input type="password" class="form-control" aria-describedby="pword"
                                           pattern="^([A-z]|\d){6,16}$" name=password
                                           required
                                           id=password title="Between 6 and 16 alphanumeric characters"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <div class="input-group">
                                    <span class="input-group-addon" id="conpword"><strong>*Confirm
                                            Password: </strong></span>
                                    <input type="password" class="form-control" aria-describedby="conpword"
                                           pattern="^([A-z]|\d){6,16}$"
                                           required
                                           name=confPassword id=confPassword
                                           title="Between 6 and 16 alphanumeric characters"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->emailError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->emailError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="maile"><strong>Email: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="maile"
                                           type="email" pattern="^\S+@\S+\.\S+$"
                                           name="email" id="email"
                                           title="Email must be a valid email"
                                        <?php if (isset($this->user['email'])) {
                                            echo "placeholder='" . $this->user['email'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <!-- /////////////////////////////// USER INFO \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->firstNameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->firstNameError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="fname"><strong>First Name: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="fname"
                                           name=first_name id=first_name
                                           pattern="^([A-z]){2,20}$" title="Minimum 2 letters"
                                        <?php if (isset($this->user['first_name'])) {
                                            echo "placeholder='" . $this->user['first_name'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->lastNameError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->lastNameError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="lname"><strong>Last Name: </strong></span>
                                    <input type="text" class="form-control" aria-describedby="lname"
                                           name=last_name id=last_name pattern="^([A-z]){2,20}$"
                                           title="Minimum 2 letters"
                                        <?php if (isset($this->user['last_name'])) {
                                            echo "placeholder='" . $this->user['last_name'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->genderError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->genderError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="gen"><label
                                            for="gender_id"><strong>Gender: </strong></label></span>
                                    <select name="gender_id" id="gender_id" class="form-control" aria-describedby="gen">
                                        <option value="">Select a gender...</option>
                                        <?php
                                        foreach ($this->genders as $gender) {
                                            if (isset($this->user['gender_id']) && $this->user['gender_id'] == $gender['gender_id'])
                                                echo '<option selected value=\'' . $gender['gender_id'] . '\'>' . $gender['gender_desc']
                                                    . '</option>';
                                            else
                                                echo '<option value="' . $gender['gender_id'] . '">' . $gender['gender_desc']
                                                    . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->dobError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->dobError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="lname"><strong>Date of Birth: </strong></span>
                                    <input type="date" name=date_of_birth id="date_of_birth" class="form-control"
                                           aria-describedby="basic-addon1"
                                           pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$"
                                           title="yyyy-mm-dd"
                                           max="<?= date_sub(date_create(),
                                               date_interval_create_from_date_string('13 years'))->format('Y-m-d') ?>"
                                           min="<?= date_sub(date_create(),
                                               date_interval_create_from_date_string('101 years'))->format('Y-m-d') ?>"

                                        <?php if (isset($this->user['date_of_birth'])) {
                                            echo "value='" . $this->user['date_of_birth'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->phoneError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->phoneError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="phoneNum"><strong>Phone Number: </strong></span>
                                    <input type="phone" class="form-control" aria-describedby="phoneNum"
                                           id="phone" name="phone"
                                           pattern="^([+\-().]|\d){8,}$"
                                           title="Valid phone number "
                                        <?php if (isset($this->user['phone'])) {
                                            echo "value='" . $this->user['phone'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->addressError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->addressError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="addr"><strong>Street Address: </strong></span>
                                    <input class="form-control" aria-describedby="addr"
                                           type="text" name="address" id="address"
                                           pattern="^.{4,20}$" title="Minimum 4 characters"
                                        <?php if (isset($this->user['address'])) {
                                            echo "placeholder='" . $this->user['address'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="cty"><strong>City: </strong></span>
                                    <input class="form-control" aria-describedby="cty"
                                           type="text" name="city" id="city"
                                           pattern="^.{4,20}$" title="Minimum 4 characters"
                                        <?php if (isset($this->user['city'])) {
                                            echo "placeholder='" . $this->user['city'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="state"><strong>Province/State: </strong></span>
                                    <input class="form-control" aria-describedby="state"
                                           type="text" name="province" id="province" pattern="^.{4,20}$"
                                           title="Minimum 4 characters"
                                        <?php if (isset($this->user['province'])) {
                                            echo "placeholder='" . $this->user['province'] . "'";
                                        } ?> />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="cntry"><label
                                            for="country"><strong>Country: </strong></label></span>
                                    <select class="form-control" id="country" name="country" aria-describedby="cntry">
                                        <option>Select a country...</option>
                                        <?php foreach ($this->countries as $country) {
                                            if (isset($this->user['country']) && $this->user['country'] == $country['country_ISO_ID'])
                                                echo '<option selected="selected" value=\'' . $country['country_ISO_ID'] . '\' >'
                                                    . $country['country_name'] . '</option>';
                                            echo '<option value=' . $country['country_ISO_ID'] . '> '
                                                . $country['country_name'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <?php if (isset($this->cityError)) { ?>
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <p><?= $this->cityError ?></p>
                                    </div>
                                <?php } ?>
                                <div class="input-group">
                                    <span class="input-group-addon" id="state"><strong>Postal Code / Zip Code: </strong></span>
                                    <input class="form-control" aria-describedby="basic-addon1"
                                           type=text name=postalcode id=postalcode
                                           pattern="(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$)"

                                           title="Canada: H0H 0H0 or H0H-0H0 || US: 99999 or 99999-9999"
                                        <?php if (isset($this->user['postalcode'])) {
                                            echo "placeholder='" . $this->user['postalcode'] . "'";
                                        } ?>/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div
                                class=" col-xs-11 col-sm-8 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary btn-lg">Update my Account</button>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    <button type="button"
                                            class="btn btn-danger btn-lg"
                                            data-toggle="modal"
                                            data-target="#confirmDelete1">Close my account
                                    </button
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

