<?php

namespace DixonsCz\Chuck\Svn;

class RevisionMessage implements IRevisionMessage
{
    /**
     *
     * @var string
     */
    protected $ticketNumber;
    
    /**
     *
     * @var string
     */
    protected $message;
    
    /**
     * 
     * @param string $ticketNumber
     * @param string $message
     */
    public function __construct($ticketNumber, $message)
    {
        $this->ticketNumber = $ticketNumber;
        $this->message = $message;
    }
    
    /**
     * 
     * @param \DixonsCz\Chuck\Jira\Wrapper $jira
     * @return \DixonsCz\Chuck\Jira\IIssue
     */
    public function findJiraIssue(\DixonsCz\Chuck\Jira\Wrapper $jira)
    {
        if ($this->ticketNumber == null)
        {
            return null;
        }
        
        $issue = $jira->getTicketInfo($this->ticketNumber);
        
        if ($issue != null)
        {
            $issue->attachRevisionMessage($this);
        }
        
        return $issue;
    }

    /**
     * 
     * @return mixed[]
     */
    public function toArray()
    {
        return array(
            'ticket' => $this->ticketNumber,
            'message' => $this->message,
        );
    }

}