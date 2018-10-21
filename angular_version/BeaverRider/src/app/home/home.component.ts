import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { User } from '../_models';
import { UserService } from '../_services';

@Component({templateUrl: 'home.component.html'})
export class HomeComponent implements OnInit {
    currentUser: User;
    //users: User[] = [];
    currentUserId: string;

    constructor(private userService: UserService, private router: Router) {
        //this.currentUser = JSON.parse(localStorage.getItem('currentUser'));
    }

    ngOnInit() {
        console.log('on init');
        this.currentUserId = localStorage.getItem('currentUserId');
        //this.currentUserId = "linzhe";
        this.getUserbyuserId(this.currentUserId);
    }

    /**
    deleteUser(userId: string) {
        this.userService.delete(userId).pipe(first()).subscribe(() => { 
            this.loadAllUsers() 
        });
    }
    */

    getUserbyuserId(userId: string){
        this.userService.getById(this.currentUserId).pipe(first()).subscribe(user => {
            this.currentUser=user;
            console.log(this.currentUser);
            localStorage.setItem('currentUser', JSON.stringify(this.currentUser));
            console.log("get currentUser");
            console.log(localStorage.getItem('currentUser'));
            console.log(this.currentUser);
            if (this.currentUser.finishRegister==0){
                this.router.navigate(['profile']);
            }
        });
        
    }

    /** 
    private loadAllUsers() {
        this.userService.getAll().pipe(first()).subscribe(users => { 
            this.users = users; 
        });
    }
    */

    userLogout(): void{
        //this.userService.logout();
        localStorage.clear();
        //this.router.navigate(['']);
        window.location.href="http://web.engr.oregonstate.edu/~hezhi/beaverrider"
    }


}