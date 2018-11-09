import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AlertService, PostRequestService } from '../_services';
import { Post } from '../_models';
import { getLocaleTimeFormat } from '@angular/common';

@Component({
  selector: 'app-new-post',
  templateUrl: './new-post.component.html',
  styleUrls: ['./new-post.component.css']
})
export class NewPostComponent implements OnInit {

    postForm: FormGroup;
    loading = false;
    submitted = false;
    newPost: Post;

    constructor(
            private formBuilder: FormBuilder,
            private router: Router,
            private postrequestservice: PostRequestService,
            private alertService: AlertService
    ) { }

    ngOnInit() {
        this.postForm = this.formBuilder.group({
            post_orderid: [''],
            post_userid: [''],
            departure_location: ['', Validators.required],
            destination_location: ['', Validators.required],
            departure_city: ['', Validators.required],
            departure_state: ['', Validators.required],
            destination_city: ['', Validators.required],
            destination_state: ['', Validators.required],
            departure_time: ['', Validators.required],
            //11/5/2018, 5:00:10 PM
            //2018-11-07 16:34:00
            post_time: [''],
            remarks: ['', Validators.required],
            available_seats: [null, Validators.required],
            available: [],
            finished: [],
            waitlist: [],
            acceptlist: []
        });
    }

    get f() { return this.postForm.controls; }

    onSubmit() {
        this.submitted = true;

        //let postDate = new Date();
        this.postForm.value.post_time = this.timestampToTime();
        //console.log(this.timestampToTime(postDate.getTime()));
        //2018-11-07 16:34:00
        //postDate.getTime()




        this.postForm.value.post_userid = localStorage.getItem('currentUserId');
        this.postForm.value.available = 1;
        this.postForm.value.finished = 0;
        // stop here if form is invalid
        if (this.postForm.invalid) {
            return;
        }

        //console.log('profileForm.value')
        //console.log(this.profileForm.value);
        //this.postForm.value.finishRegister = 1;

        this.loading = true;
        this.postrequestservice.insertPost(this.postForm.value)
            .pipe(first())
            .subscribe(
                success => {
                    this.alertService.success('inseat post successful', true);
                    console.log('inseat successful');
                    this.router.navigate(['']);
                    //this.postForm.value.finishRegister = 1;
                },
                error => {
                    this.alertService.error(error);
                    console.log('inseat err');
                    this.loading = false;
                    this.router.navigate(['']);
                    //this.postForm.value.finishRegister = 1;
                });
        }

    timestampToTime() {
        //var date = new Date(timestamp * 1000);
        let postDate = new Date();
        //console.log(date.getFullYear());

        let Y = postDate.getFullYear() + '-';
        let M = (postDate.getMonth()+1 < 10 ? '0'+(postDate.getMonth()+1) : postDate.getMonth()+1) + '-';
        let D = postDate.getDate() + ' ';
        let h = postDate.getHours() + ':';
        let m = postDate.getMinutes() + ':';
        let s = postDate.getSeconds();
        return Y+M+D+h+m+s;
    }


}
