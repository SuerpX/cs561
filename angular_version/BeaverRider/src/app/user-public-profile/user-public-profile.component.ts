import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';
import { Router } from '@angular/router';
import { User } from '../_models';
import { UserService } from '../_services';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-public-profile',
  templateUrl: './user-public-profile.component.html',
  styleUrls: ['./user-public-profile.component.css']
})
export class UserPublicProfileComponent implements OnInit {

  user: User;
  userId: string;

  constructor(private userService: UserService, private router: Router, private route: ActivatedRoute) { }

  ngOnInit() {
    this.userId = this.route.snapshot.paramMap.get('userid');
    //this.userId = "linzhe";
    this.getUserbyuserId(this.userId);
  }

  getUserbyuserId(userId: string){
      this.userService.getById(this.userId).pipe(first()).subscribe(user => {
      this.user=user;
  });
    
}

}
