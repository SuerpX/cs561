import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { UserService } from '../_services';

@Component({templateUrl: 'home.component.html'})

export class HomeComponent implements OnInit {

    switch_flag: number = 1;
    post_active: string = 'active';
    request_active: string = '';

    constructor(private userService: UserService, private router: Router) {
        //this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
    }

    ngOnInit() {}


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