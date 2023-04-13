<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GetCountArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tag:count {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return the count of articles linked to the tag with the id {id}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tag_id = $this->argument('id');
        // $article_count2 = DB::table('articles_tags')->where('tag_id', '=', $tag_id)->count();
        $article_count =count(Tag::with("articles")->findOrFail($tag_id)->articles);
        echo "The count of articles linked to the tag with the id $tag_id - article_count  $article_count\n";
    }
}
