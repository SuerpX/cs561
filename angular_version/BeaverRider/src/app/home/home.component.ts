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


    constructor(
            private userService: UserService,
            private router: Router,
            private formBuilder: FormBuilder,
            private postrequestservice: PostRequestService,
            private alertService: AlertService
        ) {
        //this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
    }

    ngOnInit() {
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