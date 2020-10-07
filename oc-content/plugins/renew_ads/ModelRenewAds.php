<?php
	/*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    /**
     * Model database for osclass PM tables
     *
     * @package OSClass
     * @subpackage Model
     * @1.0
     */
	 
	 class ModelRenewAds extends DAO
    {
        
        private static $instance ;

       
        public static function newInstance()
        {
            if( !self::$instance instanceof self ) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        
        function __construct()
        {
            parent::__construct();
        }
		
		 public function getTable_RenewAds()
        {
            return DB_TABLE_PREFIX.'t_item_renew_ads';
        }
		
		public function getTable_DeletedExpiredAds()
        {
            return DB_TABLE_PREFIX.'t_item_deleted_expired_ads';
        }
		
		public function getTable_CategoryExp()
        {
            return DB_TABLE_PREFIX.'t_category';
        }
		
		public function import($file)
        {
            $path = osc_plugin_resource($file) ;
            $sql = file_get_contents($path);

            if(! $this->dao->importSQL($sql) ){
                throw new Exception( "Error importSQL::ModelRenewAds<br>".$file ) ;
            }
        }
		
		 public function uninstall()
        {
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTable_RenewAds()) ) ;   
			$this->dao->query(sprintf('DROP TABLE %s', $this->getTable_DeletedExpiredAds()) ) ;            
        }
		
		public function getUserExpiredItem($userId, $start = 0, $end = null) { 
		$date = date('Y-m-d H:i:s');
		$this->dao->select('*');
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$this->dao->where("fk_i_user_id", $userId);
		$this->dao->where("dt_expiration < ", $date);
		if($end!=null) {
                $this->dao->limit($start, $end);
            } else if ($start > 0 ) {
                $this->dao->limit($start);
            }

            $result = $this->dao->get();
            if($result == false) {
                return array();
            }
            $items  = $result->result();
			$items2 = Item::newInstance()->extendData($items);
            return $items2;
		}
		
		public function get_expiration_days($ItemCategoryId){
			$this->dao->select();
            $this->dao->from($this->getTable_CategoryExp() );
            $this->dao->where('pk_i_id', $ItemCategoryId);
			$result = $this->dao->get();
            if($result == NULL){
				return NULL;
			} else {
				return $result->row();
			}	
		}
		
		public function item_is_renewed($ItemId){
			$this->dao->select();
            $this->dao->from($this->getTable_RenewAds() );
            $this->dao->where('fk_i_item_id', $ItemId);
			$result = $this->dao->get();
            $renewed_times = $result->row();
			if(!$renewed_times){
				return false;
			} else {
			return $renewed_times;
			}
		}
		
		public function renewed_items(){
			$this->dao->select('*');
            $this->dao->from($this->getTable_RenewAds() );
			$this->dao->orderBy('last_renewed DESC');
			$result = $this->dao->get();
            return $result->result();
		}
		
		public function DeletedExpiredItems(){
			$this->dao->select('*');
            $this->dao->from($this->getTable_DeletedExpiredAds() );
			$this->dao->orderBy('deleted_date DESC');
			$result = $this->dao->get();
			if(!$result){
				return false; 
			} else {
            return $result->result();
			}
		}
		
		public function ExpiringItem() { 
		$date = date('Y-m-d H:i:s');
		$newDate = date('Y-m-d H:i:s', strtotime('+3 days'));
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$this->dao->where('b_enabled', 1);
		$this->dao->where('b_active', 1);
		$this->dao->where('b_spam', 0);
		$this->dao->where("dt_expiration BETWEEN '$date' AND '$newDate'");
		$this->dao->orderBy('dt_expiration ASC');
		$result = $this->dao->get();
		return $result->result();
		}
		
		public function getExpiredItem() { 
		$days = osc_get_preference('delete_expired_after_days','renew_ads');
		$today=date('Y-m-d H:i:s');
		$date = date('Y-m-d H:i:s', strtotime($today. ' - '.$days.' days'));
		$this->dao->select('*');
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$this->dao->where("dt_expiration <= '" . $date . "'");
            $result = $this->dao->get();
            if($result == false) {
                return array();
            }
            $items  = $result->result();
			$items2 = Item::newInstance()->extendData($items);
            return $items2;
		}
		
		public function GetItemRow($itemId) { 
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$this->dao->where("pk_i_id", $itemId);
		$result = $this->dao->get();
		return $result->result();
		}
		
		public function getSpamItem() { 
		$this->dao->select('*');
		$this->dao->from(DB_TABLE_PREFIX . 't_item');
		$this->dao->where("b_spam = 1");
		$result = $this->dao->get();
            if($result == false) {
                return array();
            }
            $items  = $result->result();
			$items2 = Item::newInstance()->extendData($items);
            return $items2;
		
		}
		
		public function GetCronTimeHourly(){
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'HOURLY');
		$result = $this->dao->get();
		return $result->result();
		}
	
		public function GetCronTimeDaily(){
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'DAILY');
		$result = $this->dao->get();
		return $result->result();
		}
	
		public function GetCronTimeWeekly(){
		$this->dao->select();
		$this->dao->from(DB_TABLE_PREFIX . 't_cron');
		$this->dao->where('e_type', 'WEEKLY');
		$result = $this->dao->get();
		return $result->result();
		}
		
		public function countExpiredItemsByUserID($userId)
        {
            $this->dao->select('count(pk_i_id) as total');
            $this->dao->from(DB_TABLE_PREFIX . 't_item');
            $this->dao->where("fk_i_user_id = $userId");
			$this->dao->where("dt_expiration <= '" . date('Y-m-d H:i:s') . "'");
			$result = $this->dao->get();
            if($result == false) {
                return 0;
            }
            $items  = $result->row();
            return $items['total'];
        }

	

	 
	}
	 ?>