import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DriverActivePostComponent } from './driver-active-post.component';

describe('DriverActivePostComponent', () => {
  let component: DriverActivePostComponent;
  let fixture: ComponentFixture<DriverActivePostComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DriverActivePostComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DriverActivePostComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
