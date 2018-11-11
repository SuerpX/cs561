import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';

@Component({
  selector: 'app-passenger-request',
  templateUrl: './passenger-request.component.html',
  styleUrls: ['./passenger-request.component.css']
})
export class PassengerRequestComponent implements OnInit {

  confirmedRequestList: Request[] = [];
  unconfirmedRequestList: Request[] = [];

  constructor(private postrequestService: PostRequestService, private router: Router ) { }

  ngOnInit() {
    this.getConfirmedRequestList();
    this.getUnconfirmedRequestList();
  }

  getConfirmedRequestList(){
    let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getConfirmedRequest(currentUserId).pipe(first()).subscribe(requestList => {
      this.confirmedRequestList = requestList;
    });
  }

  getUnconfirmedRequestList(){
    let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getUnconfirmedRequest(currentUserId).pipe(first()).subscribe(requestList => {
      this.unconfirmedRequestList = requestList;
    });
  }

}
