<?php namespace Qdiscuss\Api\Serializers;

class PostBasicSerializer extends BaseSerializer
{
	/**
	 * The resource type.
	 *
	 * @var string
	 */
	protected $type = 'posts';

	/**
	 * Default relations to link.
	 *
	 * @var array
	 */
	protected $link = ['discussion'];

	/**
	 * Default relations to include.
	 *
	 * @var array
	 */
	protected $include = ['user'];

	/**
	 * Serialize attributes of a Post model for JSON output.
	 *
	 * @param Post $post The Post model to serialize.
	 * @return array
	 */
	protected function attributes($post)
	{
		$attributes = [
			'id'      => (int) $post->id,
			'number'  => (int) $post->number,
			'time'    => $post->time->toRFC3339String(),
			'contentType'    => $post->type
		];

		if ($post->type === 'comment') {
			// $attributes['excerpt'] = str_limit($post->contentPlain, 200);
			$attributes['excerpt'] = str_limit($post->content, 200);//@todo, just hack to show content
		} else {
			$attributes['content'] = $post->content;
		}

		return $this->extendAttributes($post, $attributes);
	}

	public function user()
	{
		return $this->hasOne('Qdiscuss\Api\Serializers\UserBasicSerializer');
	}

	public function discussion()
	{
		return $this->hasOne('Qdiscuss\Api\Serializers\DiscussionBasicSerializer');
	}
}
