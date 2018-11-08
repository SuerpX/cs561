import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AlertService, PostRequestService } from '../_services';
import { Post } from '../_models';
import { getLocaleTimeFormat } from '@angular/common';

@Component({
  selector: 'app-new-request',
  templateUrl: './new-request.component.html',
  styleUrls: ['./new-request.component.css']
})
export class NewRequestComponent implements OnInit {

  requestForm: FormGroup;
  loading = false;
  submitted = false;
  newResquest: Request;

  constructor(
            private formBuilder: FormBuilder,
            private router: Router,
            private postrequestservice: PostRequestService,
            private alertService: AlertService
  ) { }

  ngOnInit() {
    this.requestForm = this.formBuilder.group({
      request_orderid: [''],
      request_userid: [''],
      departure_location: ['', Validators.required],
      destination_location: ['', Validators.required],
      departure_time: ['', Validators.required],
      //11/5/2018, 5:00:10 PM
      //2018-11-07 16:34:00
      post_time: [''],
      remarks: ['', Validators.required],
      people_number: [null, Validators.required],
      available: [],
      finished: [],
      waitlist: [],
      acceptlist: []
  });
  }

  get f() { return this.requestForm.controls; }

  onSubmit() {
    this.submitted = true;

    //let postDate = new Date();
    this.requestForm.value.post_time = this.timestampToTime();
    //console.log(this.timestampToTime(postDate.getTime()));
    //2018-11-07 16:34:00
    //postDate.getTime()




    this.requestForm.value.request_userid = localStorage.getItem('currentUserId');
    this.requestForm.value.available = 1;
    this.requestForm.value.finished = 0;
    // stop here if form is invalid
    if (this.requestForm.invalid) {
        return;
    }

    //console.log('profileForm.value')
    //console.log(this.profileForm.value);
    //this.postForm.value.finishRegister = 1;

    this.loading = true;
    this.postrequestservice.insertRequest(this.requestForm.value)
        .pipe(first())
        .subscribe(
            success => {
                this.alertService.success('inseat request successful', true);
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
