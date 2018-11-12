import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { PostRequestService } from '../_services';

@Component({
  selector: 'app-request-list',
  templateUrl: './request-list.component.html',
  styleUrls: ['./request-list.component.css']
})
export class RequestListComponent implements OnInit {

  requestList: Request[] = [];
  currentUserId: string;

  constructor(private postrequestService: PostRequestService, private router: Router ) { }

  ngOnInit() {
    this.getRequestList();
    this.currentUserId = localStorage.getItem('currentUserId');
  }

  getRequestList(){
    this.postrequestService.getRequestList().pipe(first()).subscribe(requestList => {
      this.requestList = requestList;
    });
  }

}
