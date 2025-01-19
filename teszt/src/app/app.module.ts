import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from "@angular/common/http";
import { RecipeService } from './shared/services/recipe.service';
import { PostService } from './shared/services/post.service';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { MessagesComponent } from './messages/messages.component';
import { MessageListComponent } from './messages/message-list/message-list.component';
import { MessageItemComponent } from './messages/message-list/message-item/message-item.component';
import { FoodOfRecipesComponent } from './food-of-recipes/food-of-recipes.component';
import { FoodOfRecipeListComponent } from './food-of-recipes/food-of-recipe-list/food-of-recipe-list.component';
import { FoodOfRecipeItemComponent } from './food-of-recipes/food-of-recipe-list/food-of-recipe-item/food-of-recipe-item.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    MessagesComponent,
    MessageListComponent,
    MessageItemComponent,
    FoodOfRecipesComponent,
    FoodOfRecipeListComponent,
    FoodOfRecipeItemComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule
  ],
  providers: [
    RecipeService,
    PostService,
    provideClientHydration()
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
