/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/SQLTemplate.sql to edit this template
 */
/**
 * Author:  CHHIMEKI INFOSYS
 * Created: Feb 15, 2023
 */
--  <div class="container border">
--         <div class="row">
--             <div class="col-md-4 co-sm-12 col-lg-4"></div>
--             <div class="col-md-4 co-sm-12 col-lg-4"></div>
--             <div class="col-md-4 co-sm-12 col-lg-4"></div>
-- 
--         </div>
--     </div>
1. ALTER TABLE `counter` ADD `manager` VARCHAR(255) NULL DEFAULT NULL AFTER `status`, ADD `manager_sign` VARCHAR(255) NULL DEFAULT NULL AFTER `manager`;
