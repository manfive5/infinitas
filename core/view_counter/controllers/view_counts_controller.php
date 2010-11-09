<?php
	class ViewCountsController extends ViewCounterAppController{
		public $name = 'ViewCounts';

		/**
		 * Generate reports on views
		 *
		 * Create pretty graphs of all the data collected for the
		 */
		public function admin_reports(){
			$byMonth = $byWeek = $byDay = $relatedModel = $byRegion = $foreignKeys = $allModels = null;
			
			$conditions = $this->Filter->filter;
			$conditions['month >= '] = date('Y-m', mktime(0, 0, 0, date('m') - 12));
			if(isset($this->params['named']['ViewCount.foreign_key'])){
				$conditions['ViewCount.foreign_key'] = $this->params['named']['ViewCount.foreign_key'];
			}

			$byMonth = $this->ViewCount->reportByMonth($conditions);

			$conditions['month >= '] = date('m') -3;
			$byWeek = $this->ViewCount->reportByWeek($conditions);
			$byDay  = $this->ViewCount->reportByDay($conditions);
			
			$this->set(compact('byMonth', 'byWeek', 'byDay'));

			if(isset($this->params['named']['ViewCount.model']) && isset($this->params['named']['ViewCount.foreign_key'])){
				$relatedModel = $this->ViewCount->reportPopularRows($conditions, $this->params['named']['ViewCount.model']);
				if(isset($relatedModel[0])){
					$relatedModel = $relatedModel[0];
				}

				$byRegion = $this->ViewCount->reportByRegion($conditions);
				$this->set(compact('relatedModel', 'byRegion'));
			}

			else if(isset($this->params['named']['ViewCount.model']) && !isset($this->params['named']['ViewCount.foreign_key'])){
				$foreignKeys = $this->ViewCount->reportPopularRows($conditions, $this->params['named']['ViewCount.model']);
				$byRegion = $this->ViewCount->reportByRegion($conditions);
				$this->set(compact('foreignKeys', 'byRegion'));
			}
			
			else if(!isset($this->params['named']['ViewCount.model']) && !isset($this->params['named']['ViewCount.foreign_key'])){
				$allModels = $this->ViewCount->reportPopularModels();
				$this->set(compact('allModels'));
			}
		}
	}