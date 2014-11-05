<?php

class AdminCommentsController extends AdminController
{

    /**
     * equip Model
     * @var equip
     */
    //protected $equips;

    /**
     * Inject the models.
     * @param equip $equip
     */
    public function __construct(equip $equip)
    {
        parent::__construct();
        $this->equips = $equip;
    }

    /**
     * Show a list of all the equip posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/comments/title.comment_management');

        // Grab all the comment posts
        #$comments = $this->comment;
	$equips = $this->equips;
        // Show the page
        return View::make('admin/comments/index', compact('equips', 'title'));
    }

    

}
