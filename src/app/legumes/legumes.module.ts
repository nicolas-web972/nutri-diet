import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LegumesPageRoutingModule } from './legumes-routing.module';

import { LegumesPage } from './legumes.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LegumesPageRoutingModule
  ],
  declarations: [LegumesPage]
})
export class LegumesPageModule {}
