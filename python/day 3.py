"""Binary Search Function"""
def bin_search(arr, key):
	'''
	This function is an implementation of the binary search algorithm.
	Parameters:
			arr: the array to look through
			key: the value to search for.
	Returns:
		a boolean indicating whether the key was found or not.
	'''
	left = 0
	right = len(arr) - 1
	while left <= right:
		middle = (left + right) // 2
		if arr[middle] == key:
			return True
		elif arr[middle] <= key:
			left = middle + 1
		else:
			right = middle - 1
	return False
print(bin_search(list(range(0,50000000)),6))