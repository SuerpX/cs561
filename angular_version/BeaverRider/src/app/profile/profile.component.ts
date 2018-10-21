import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AlertService, UserService } from '../_services';
import { User } from '../_models';



@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
    profileForm: FormGroup;
    loading = false;
    submitted = false;
    currentUser: User;

    constructor(
        private formBuilder: FormBuilder,
        private router: Router,
        private userService: UserService,
        private alertService: AlertService) { }

    ngOnInit() {
        this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.profileForm = this.formBuilder.group({
            userId: [this.currentUser.userId, Validators.required],
            firstname: [this.currentUser.firstname, Validators.required],
            lastname: [this.currentUser.lastname, Validators.required],
            phoneNumber: [this.currentUser.phoneNumber, Validators.required],
            email: [this.currentUser.email, Validators.required],
            address: [this.currentUser.address, Validators.required],
            finishRegister: [this.currentUser.finishRegister]
        });
    }

    // convenience getter for easy access to form fields
    get f() { return this.profileForm.controls; }

    onSubmit() {
        this.submitted = true;

        // stop here if form is invalid
        if (this.profileForm.invalid) {
            return;
        }

        console.log('profileForm.value')
        console.log(this.profileForm.value);
        this.profileForm.value.finishRegister = 1;

        this.loading = true;
        this.userService.update(this.profileForm.value)
            .pipe(first())
            .subscribe(
                data => {
                    this.alertService.success('Update profile successful', true);
                    console.log('update successful');
                    this.router.navigate(['']);
                    //this.profileForm.value.finishRegister = 1;
                },
                error => {
                    this.alertService.error(error);
                    console.log('update err');
                    this.loading = false;
                    this.router.navigate(['']);
                    //this.profileForm.value.finishRegister = 1;
                });
    }

}
