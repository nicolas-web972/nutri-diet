import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ViandesPageRoutingModule } from './viandes-routing.module';

import { ViandesPage } from './viandes.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ViandesPageRoutingModule
  ],
  declarations: [ViandesPage]
})
export class ViandesPageModule {}
