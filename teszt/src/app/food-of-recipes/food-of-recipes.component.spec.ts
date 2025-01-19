import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FoodOfRecipesComponent } from './food-of-recipes.component';

describe('FoodOfRecipesComponent', () => {
  let component: FoodOfRecipesComponent;
  let fixture: ComponentFixture<FoodOfRecipesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FoodOfRecipesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FoodOfRecipesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
