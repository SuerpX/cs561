import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AlertService, PostRequestService } from '../_services';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { UserService } from '../_services';

@Component({templateUrl: 'home.component.html'})

export class HomeComponent implements OnInit {

    switch_flag: number = 1;
    post_active: string = 'active';
    request_active: string = '';

    matchForm: FormGroup;
    loading = false;
    submitted = false;

    constructor(
        private userService: UserService,
        private router: Router,
        private formBuilder: FormBuilder,
        private postrequestservice: PostRequestService
        ) {
        //this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
    }

    ngOnInit() {
        this.matchForm = this.formBuilder.group({
            post_orderid: [''],
            post_userid: [''],
            //departure_location: ['', Validators.pattern('\s[A-z]+')],
            departure_location: ['', Validators.required],
            destination_location: ['', Validators.required],
            departure_city: ['', Validators.required],
            departure_state: ['', Validators.required],
            destination_city: ['', Validators.required],
            destination_state: ['', Validators.required],
            departure_time: ['', Validators.required],
            //2018-11-07 16:34:00
            post_time: [''],
            remarks: [''],
            available_seats: [null, Validators.required],
            available: [],
            finished: [],
            waitlist: [],
            acceptlist: []
        });
    }


    switch_request(): void{
        this.switch_flag = 0;
        this.post_active = '';
        this.request_active = 'active';
    }

    switch_post(): void{
        this.switch_flag = 1;
        this.post_active = 'active';
        this.request_active = '';
    }


}