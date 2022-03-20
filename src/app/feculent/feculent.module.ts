import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { FeculentPageRoutingModule } from './feculent-routing.module';

import { FeculentPage } from './feculent.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    FeculentPageRoutingModule
  ],
  declarations: [FeculentPage]
})
export class FeculentPageModule {}
