import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { first } from 'rxjs/operators';
import { AlertService, PostRequestService } from '../_services';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-new-request-invite',
  templateUrl: './new-request-invite.component.html',
  styleUrls: ['./new-request-invite.component.css']
})
export class NewRequestInviteComponent implements OnInit {

  requestForm: FormGroup;
  loading = false;
  submitted = false;
  newRequest: Request;
  postDetail: Post;
  postid: string;
  flag: number;

  constructor(
            private formBuilder: FormBuilder,
            private router: Router,
            private postrequestservice: PostRequestService,
            private alertService: AlertService,
            private route: ActivatedRoute
  ) { }

  ngOnInit() {
    this.postid = this.route.snapshot.paramMap.get('postid');
    this.getPostDetail();
  }

  get f() { return this.requestForm.controls; }

  getPostDetail(){
    this.postrequestservice.getPostDetail(this.postid).pipe(first()).subscribe(post => {
          this.postDetail = post;
          this.requestForm = this.formBuilder.group({
              request_orderid: [''],
              request_userid: [''],
              departure_location: [this.postDetail.departure_location, Validators.required],
              departure_city: [this.postDetail.departure_city, Validators.required],
              departure_state: [this.postDetail.departure_state, Validators.required],
      
              destination_location: [this.postDetail.destination_location, Validators.required],
              destination_city: [this.postDetail.destination_city, Validators.required],
              destination_state: [this.postDetail.destination_state, Validators.required],
              departure_time: [this.postDetail.departure_time, Validators.required],
              //2018-11-07 16:34:00
              post_time: [''],
              remarks: ['', Validators.required],
              people_number: ['', Validators.required],
              available: [],
              finished: [],
              waitlist: [],
              acceptlist: []
          });
          this.flag = 1;
          console.log(this.requestForm.value);
          
  });
}

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
      console.log(this.requestForm.value);
      return;
  }

  //console.log('profileForm.value')
  //console.log(this.profileForm.value);
  //this.requestForm.value.finishRegister = 1;

  this.loading = true;

  this.postrequestservice.insertRequestfromJoin(this.requestForm.value, this.postid)
      .pipe(first())
      .subscribe(
          success => {
              this.alertService.success('inseat request successful', true);
              console.log('inseat successful');
              console.log(this.requestForm.value);
              
              this.router.navigate(['']);
              //this.requestForm.value.finishRegister = 1;
          },
          error => {
              this.alertService.error(error);
              console.log('inseat err');
              this.loading = false;
              this.router.navigate(['']);
              //this.requestForm.value.finishRegister = 1;
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
