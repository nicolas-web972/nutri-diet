import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LaitagesPageRoutingModule } from './laitages-routing.module';

import { LaitagesPage } from './laitages.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LaitagesPageRoutingModule
  ],
  declarations: [LaitagesPage]
})
export class LaitagesPageModule {}
