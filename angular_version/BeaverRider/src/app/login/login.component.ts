import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({templateUrl: 'login.component.html'})
export class LoginComponent implements OnInit {

    xmlurl: string;
    xmlDoc: any;

    constructor(
        private http: HttpClient
    ) {}

    ngOnInit() {
        var ticket = this.getQueryVariable("ticket");
        this.xmlurl = "https://login.oregonstate.edu/idp/profile/cas/serviceValidate?ticket=" + ticket + "&service=http://web.engr.oregonstate.edu/~hezhi/test/login";
        
        this.getxml();
        console.log(this.xmlDoc);

        /** 
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET",this.xmlurl,false);
        xmlhttp.send();
        this.xmlDoc = xmlhttp.responseXML;
        let xmluserval = this.xmlDoc.getElementsByTagName("cas:commonName")[0].childNodes[0].nodeValue;
        console.log(this.xmlDoc);
        */



    }

    getQueryVariable(variable){
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
    }

    getxml() {

        this.http.get(this.xmlurl, {responseType: 'text'})
            .subscribe(data => this.xmlDoc = data);

    }

}


/**
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';

import { AlertService, AuthenticationService } from '../_services';

@Component({templateUrl: 'login.component.html'})
export class LoginComponent implements OnInit {
    loginForm: FormGroup;
    loading = false;
    submitted = false;
    returnUrl: string;

    constructor(
        private formBuilder: FormBuilder,
        private route: ActivatedRoute,
        private router: Router,
        private authenticationService: AuthenticationService,
        private alertService: AlertService) {}

    ngOnInit() {
        this.loginForm = this.formBuilder.group({
            username: ['', Validators.required],
            password: ['', Validators.required]
        });

        // reset login status
        this.authenticationService.logout();

        // get return url from route parameters or default to '/'
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    // convenience getter for easy access to form fields
    get f() { return this.loginForm.controls; }

    onSubmit() {
        this.submitted = true;

        // stop here if form is invalid
        if (this.loginForm.invalid) {
            return;
        }

        this.loading = true;
        this.authenticationService.login(this.f.username.value, this.f.password.value)
            .pipe(first())
            .subscribe(
                data => {
                    this.router.navigate([this.returnUrl]);
                },
                error => {
                    this.alertService.error(error);
                    this.loading = false;
                });
    }
}

 */