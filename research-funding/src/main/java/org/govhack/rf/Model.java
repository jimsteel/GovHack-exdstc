/**
 * 
 */
package org.govhack.rf;

import java.util.ArrayList;
import java.util.List;

/**
 * @author ametke
 *
 */
public class Model {
	private List<Row> rows = new ArrayList<>();
	private List<EdgePair> edgeList = new ArrayList<>();
	
	public List<Row> getRows() {
		return rows;
	}
	public void setRows(List<Row> rows) {
		this.rows = rows;
	}
	public List<EdgePair> getEdgeList() {
		return edgeList;
	}
	public void setEdgeList(List<EdgePair> edgeList) {
		this.edgeList = edgeList;
	}
	@Override
	public String toString() {
		return "Model [rows=" + rows + ", edgeList=" + edgeList + "]";
	}
	
}
