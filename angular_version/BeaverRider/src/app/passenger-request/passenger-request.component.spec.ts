import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PassengerRequestComponent } from './passenger-request.component';

describe('PassengerRequestComponent', () => {
  let component: PassengerRequestComponent;
  let fixture: ComponentFixture<PassengerRequestComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PassengerRequestComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PassengerRequestComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
