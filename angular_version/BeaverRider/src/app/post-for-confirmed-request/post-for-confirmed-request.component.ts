import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { Post, Request } from '../_models';
import { ActivatedRoute } from '@angular/router';
import { AlertService, PostRequestService } from '../_services';

@Component({
  selector: 'app-post-for-confirmed-request',
  templateUrl: './post-for-confirmed-request.component.html',
  styleUrls: ['./post-for-confirmed-request.component.css']
})
export class PostForConfirmedRequestComponent implements OnInit {

  post: Post;
  requestid: string;

  constructor(private alertService: AlertService, private postrequestService: PostRequestService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.requestid = this.route.snapshot.paramMap.get('orderid');
    this.getPost();
  }

  getPost(){
    //let currentUserId = localStorage.getItem('currentUserId');
    this.postrequestService.getPostForConfirmedRequest(this.requestid).pipe(first()).subscribe(post => {
      this.post = post;
      console.log(this.post);
      
    });
  }

}
