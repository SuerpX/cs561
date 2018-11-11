import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WaitlistForRequestComponent } from './waitlist-for-request.component';

describe('WaitlistForRequestComponent', () => {
  let component: WaitlistForRequestComponent;
  let fixture: ComponentFixture<WaitlistForRequestComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WaitlistForRequestComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WaitlistForRequestComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
