import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';


@Component({
  selector: 'app-request-list',
  templateUrl: './request-list.component.html',
  styleUrls: ['./request-list.component.css']
})
export class RequestListComponent implements OnInit {

  requestList: Request[] = [];
  currentUserId: string;

  matchForm: FormGroup;
  loading = false;
  submitted = false;

  constructor(private postrequestService: PostRequestService, private router: Router, private formBuilder: FormBuilder ) { }

  ngOnInit() {
    this.matchForm = this.formBuilder.group({
      departure_city: ['', Validators.required],
      departure_state: ['', Validators.required],
      destination_city: ['', Validators.required],
      destination_state: ['', Validators.required],
    });
    this.getRequestList();
    this.currentUserId = localStorage.getItem('currentUserId');
  }

  get f() { return this.matchForm.controls; }


  getRequestList(){
    this.postrequestService.getRequestList().pipe(first()).subscribe(requestList => {
      this.requestList = requestList;
    });
  }

  onSubmit() {
    this.submitted = true;

    if (this.matchForm.invalid) {
        console.log(this.matchForm.value);
        
        return;
    }
    console.log("onsubmit");
    
    this.postrequestService.getRequestListBycondition(this.matchForm.value.departure_state, this.matchForm.value.destination_state, this.matchForm.value.departure_city, this.matchForm.value.destination_city).pipe(first()).subscribe(request => {
        this.requestList = request;
        console.log(this.requestList);
        
      });
    
    }

}
