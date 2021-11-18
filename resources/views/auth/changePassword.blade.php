@extends('components.header1')
@section('content')

@if(isset(auth()->user()->id))
<form action="student-edit-account.html">
    <div class="row">
        <div class="col-lg-9">

            <div class="page-section">
                <h4>Change Password</h4>

                <div class="alert alert-light border-1 border-left-3 border-left-accent d-flex mb-24pt" role="alert">
                    <i class="material-icons text-accent mr-3">check_circle</i>
                    <div class="text-body">An email with password reset instructions has been sent to your email address, if it exists on our system.</div>
                </div>

                <div class="list-group list-group-form">
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Current Password ...">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">New password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Password ...">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group row mb-0">
                            <label class="col-form-label col-sm-3">Confirm password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" placeholder="Confirm password ...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 page-nav">
            <div class="page-section pt-lg-112pt">
                <nav class="nav page-nav__menu">
                    <a class="nav-link" href="student-edit-account.html">Basic Information</a>
                    <a class="nav-link active" href="student-edit-account-password.html">Change Password</a>
                </nav>
                <div class="page-nav__content">
                    <button type="submit" class="btn btn-accent">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
@else
<h1>Debes estár logueado primero</h1>
@endif


@stop
