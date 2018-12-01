import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-user-center',
  templateUrl: './user-center.component.html',
  styleUrls: ['./user-center.component.css']
})
export class UserCenterComponent implements OnInit {
  switch_flag: number = 1;
  driver_active: string = 'active';
  passenger_active: string = '';

  constructor() { }

  ngOnInit() {
  }

  switch_passenger(): void{
    this.switch_flag = 0;
    this.driver_active = '';
    this.passenger_active = 'active';
  }

  switch_driver(): void{
    this.switch_flag = 1;
    this.driver_active = 'active';
    this.passenger_active = '';
  }

}
