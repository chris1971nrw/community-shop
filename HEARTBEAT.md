```markdown
# Keep this file empty (or with only comments) to skip heartbeat API calls.

# Add tasks below when you want the agent to check something periodically.
```

## Related

- [Heartbeat config](/gateway/config-agents)

## Task Queue Check
0. Record heartbeat: POST http://localhost:3333/api/heartbeat via exec (curl -X POST)

1. Check in-progress tasks: GET http://localhost:3333/api/tasks and filter for status "in-progress" with pickedUp=true.
   For each in-progress task that has a subagentId:
   - Use sessions_list or /subagents info to check the sub-agent's status
   - If sub-agent COMPLETED: POST http://localhost:3333/api/tasks/{id}/status-check with { "status": "completed", "message": "<result summary from sub-agent>" }
   - If sub-agent FAILED: POST with { "status": "failed", "message": "<error details>" }
   - If sub-agent STILL RUNNING: POST with { "status": "running", "message": "Sub-agent active" }
   - If sub-agent NOT FOUND (crashed/disappeared) and task started > 15 min ago: POST with { "status": "timeout", "message": "Sub-agent session not found after 15min" }
   - If sub-agent NOT FOUND but task started < 15 min ago: POST with { "status": "running", "message": "Sub-agent recently started, waiting" }

2. Pick up new tasks: Fetch http://localhost:3333/api/tasks/queue?limit=capacity via exec (curl).
   Parse the JSON response — format: { tasks: [...], maxConcurrent, activeCount, remainingSlots }
   For each task in .tasks (already limited to available capacity):
   a. POST http://localhost:3333/api/tasks/{id}/pickup with { "subagentId": "<session-uuid>" }
   b. Spawn a sub-agent (sessions_spawn) with the task title + description as the prompt
   c. If a skill is assigned, tell the sub-agent to read that skill's SKILL.md first
   d. The sub-agent should call POST http://localhost:3333/api/tasks/{id}/complete with { "result": "<summary>" } when done, or { "error": "<what went wrong>" } if failed
