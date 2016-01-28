<?php 

class RSSGenerator{

	public static function rss($news){
		$string = "<rss version='2.0'>";
		$string .= "<channel>";
		$string .= "<title>Puškice</title>
					<link>".Request::root()."</link>
					<description>Tačka spajanja studenata FON-a</description>
					<language>sr-rs</language>
					<pubDate>".date("D, d M Y H:i:s e", strtotime("now"))."</pubDate>
					<lastBuildDate>".date("D, d M Y H:i:s e", strtotime("now"))."</lastBuildDate>
					<docs>http://blogs.law.harvard.edu/tech/rss</docs>
					<generator>Puškice generator</generator>
					<managingEditor>info@puskice.org</managingEditor>
					<webMaster>info@puskice.org</webMaster>";
		foreach($news as $article){
			$string .= "<item>
							<title>".$article->title."</title>
							<link>".Request::root()."/vest/".Puskice::dateToUrl($article->created_at)."/".$article->permalink."</link>
							<description><![CDATA[".Trans::_t($article->short_content)."]]></description>
							<pubDate>".date("D, d M Y H:i:s e", strtotime($article->created_at))."</pubDate>
							<guid>".Request::root()."/vest/".Puskice::dateToUrl($article->created_at)."/".$article->permalink."</guid>
						</item>";	
		}

		$string .= "</channel>";
		$string .= "</rss>";
		return $string;
	}

	public static function sitemap(){
		
	}

}